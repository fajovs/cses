<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$examination_id = $_POST['exam_id'];

// Fetch examination and related data
$examination = $db->query(
    "SELECT * FROM examinations WHERE exam_id = :examination_id",
    [':examination_id' => $examination_id]
)->fetch();

if (!$examination) {
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
    [':subject_id' => $examination['subject_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Fetch examination questions (if needed)
$questions = $db->query(
    "SELECT * FROM exam_questions WHERE exam_id = :examination_id",
    [':examination_id' => $examination_id]
)->fetchAll();

try {
    $db->query(
        'DELETE FROM examinations WHERE exam_id = :examination_id',
        [':examination_id' => $examination_id]
    );

    $_SESSION['success'] = 'Examination deleted successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to delete examination. Please try again.';
}

// Redirect back (path updated to exams)
header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/exams'));
exit;
