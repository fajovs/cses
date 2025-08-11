<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$exam_id = $_POST['exam_id'];
$status = $_POST['status'];

// Fetch exam and related data
$exam = $db->query(
    "SELECT * FROM examinations WHERE exam_id = :exam_id",
    [':exam_id' => $exam_id]
)->fetch();

if (!$exam) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Check ownership
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

// Fetch subject (to show in header)
$subject = $db->query(
    "SELECT s.*, ps.* FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $exam['subject_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

try {
    // Update exam info
    $db->query(
        "UPDATE examinations 
             SET is_active = :status
             WHERE exam_id = :exam_id",
        [
            ':status' => $status,
            ':exam_id' => $exam_id
        ]
    );

    $_SESSION['success'] = 'Exam status updated successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to update exam status. Please try again.';
}

header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/exams'));
exit;
