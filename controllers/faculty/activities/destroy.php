<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$activity_id = $_POST['activity_id'];

// ✅ Fetch the activity and its subject
$activity = $db->query(
    "SELECT * FROM activities WHERE activity_id = :activity_id",
    [':activity_id' => $activity_id]
)->fetch();

if (!$activity) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Fetch the related subject
$subject = $db->query(
    "SELECT s.*, ps.*
     FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $activity['subject_id']]
)->fetch();

if (!$subject) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Validate that the logged-in user is the owner
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

try {
    $db->beginTransaction();

    // ✅ Delete criteria linked to the activity
    $db->query(
        "DELETE FROM activity_criteria WHERE activity_id = :activity_id",
        [':activity_id' => $activity_id]
    );

    // ✅ Delete the activity itself
    $db->query(
        "DELETE FROM activities WHERE activity_id = :activity_id",
        [':activity_id' => $activity_id]
    );

    $db->commit();
    $_SESSION['success'] = 'Activity deleted successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to delete activity: ' . $e->getMessage();
}

// ✅ Redirect back to activity list
header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/activities'));
exit;
