<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$assignment_id = $params['aid'];  // changed from eid to aid for assignment_id

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

// Fetch the assignment by assignment_id, confirm it belongs to the subject and is within deadline
$assignment = $db->query(
    "SELECT * FROM assignments 
     WHERE assignment_id = :assignment_id AND subject_id = :subject_id AND deadline >= NOW()",
    [
        ':assignment_id' => $assignment_id,
        ':subject_id' => $subject_id
    ]
)->fetch();

if (!$assignment) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Check if the student has already submitted the assignment
$existingSubmission = $db->query(
    "SELECT * FROM assignment_submissions
     WHERE assignment_id = :assignment_id AND student_id = :student_id LIMIT 1",
    [
        ':assignment_id' => $assignment_id,
        ':student_id' => $user['student_id']
    ]
)->fetch();

if ($existingSubmission) {
    $_SESSION['error'] = 'You have already submitted this assignment.';
    header('Location: ' . base_url('/student/subject/' . $subject_id . '/assignments'));
    exit;
}

// Fetch assignment criteria
$criteria = $db->query(
    "SELECT * FROM assignment_criteria 
     WHERE assignment_id = :assignment_id 
     ORDER BY criteria_id ASC",
    [':assignment_id' => $assignment_id]
)->fetchAll();

// Show assignment submission form view
view('/student/assignments/assignment.view.php', [
    'heading'   => 'Submit assignment',
    'subject'   => $subject,
    'assignment'  => $assignment,
    'criteria'  => $criteria
]);
