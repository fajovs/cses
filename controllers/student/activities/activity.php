<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$activity_id = $params['aid'];  // changed from eid to aid for activity_id

// Fetch logged-in student info
$user = $db->query(
    "SELECT * FROM students WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

// Fetch subject & section
$subject = $db->query(
    "SELECT s.*, ps.* FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $subject_id]
)->fetch();

if (!$subject) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Check if student belongs to the correct section
if ($subject['section_id'] != $user['section_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Fetch the activity by activity_id, confirm it belongs to the subject and is within deadline
$activity = $db->query(
    "SELECT * FROM activities 
     WHERE activity_id = :activity_id AND subject_id = :subject_id AND deadline >= NOW()",
    [
        ':activity_id' => $activity_id,
        ':subject_id' => $subject_id
    ]
)->fetch();

if (!$activity) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Check if the student has already submitted the activity
$existingSubmission = $db->query(
    "SELECT * FROM activity_submissions
     WHERE activity_id = :activity_id AND student_id = :student_id LIMIT 1",
    [
        ':activity_id' => $activity_id,
        ':student_id' => $user['student_id']
    ]
)->fetch();

if ($existingSubmission) {
    $_SESSION['error'] = 'You have already submitted this activity.';
    header('Location: ' . base_url('/student/subject/' . $subject_id . '/activities'));
    exit;
}

// Fetch activity criteria
$criteria = $db->query(
    "SELECT * FROM activity_criteria 
     WHERE activity_id = :activity_id 
     ORDER BY criteria_id ASC",
    [':activity_id' => $activity_id]
)->fetchAll();

// Show activity submission form view
view('/student/activities/activity.view.php', [
    'heading'   => 'Submit Activity',
    'subject'   => $subject,
    'activity'  => $activity,
    'criteria'  => $criteria
]);
