<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$activity_id = $_POST['activity_id'];
$status = $_POST['status'];

// Fetch exam and related data
$activity = $db->query(
    "SELECT * FROM activities WHERE activity_id = :activity_id",
    [':activity_id' => $activity_id]
)->fetch();

if (!$activity) {
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
    [':subject_id' => $activity['subject_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

try {
    // Update exam info
    $db->query(
        "UPDATE activities 
             SET is_active = :status
             WHERE activity_id = :activity_id",
        [
            ':status' => $status,
            ':activity_id' => $activity_id
        ]
    );

    $_SESSION['success'] = 'Activity status updated successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to update activity status. Please try again.';
}

header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/activities'));
exit;
