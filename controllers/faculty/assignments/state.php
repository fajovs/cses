<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$assignment_id = $_POST['assignment_id'];
$status = $_POST['status'];

// Fetch exam and related data
$assignment = $db->query(
    "SELECT * FROM assignments WHERE assignment_id = :assignment_id",
    [':assignment_id' => $assignment_id]
)->fetch();

if (!$assignment) {
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
    [':subject_id' => $assignment['subject_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

try {
    // Update exam info
    $db->query(
        "UPDATE assignments 
             SET is_active = :status
             WHERE assignment_id = :assignment_id",
        [
            ':status' => $status,
            ':assignment_id' => $assignment_id
        ]
    );

    $_SESSION['success'] = 'assignment status updated successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to update assignment status. Please try again.';
}

header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/assignments'));
exit;
