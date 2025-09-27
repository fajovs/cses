<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$subject_id = $params['id'] ?? null;



if (!$subject_id) {
    http_response_code(400);
    die('Subject ID is required.');
}

// ✅ Fetch the logged-in student record
$student = $db->query(
    "SELECT * FROM students WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

if (!$student) {
    http_response_code(403);
    die('Access denied.');
}

// ✅ Fetch the subject and section
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

// ✅ Ensure the student is in the correct section
if ($subject['section_id'] != $student['section_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}


// ✅ Fetch assignments the student has already submitted
$submittedAssignments = $db->query(
    "SELECT a.*, s.*
     FROM assignments a
     INNER JOIN assignment_submissions s ON a.assignment_id = s.assignment_id
     WHERE a.subject_id = :subject_id AND s.student_id = :student_id",
    [
        ':subject_id' => $subject_id,
        ':student_id' => $student['student_id']
    ]
)->fetchAll();

// ✅ Fetch assignments the student has NOT submitted
$notSubmittedAssignments = $db->query(
    "SELECT a.*
     FROM assignments a
     WHERE a.subject_id = :subject_id AND a.is_active = 1
       AND a.assignment_id NOT IN (
           SELECT assignment_id FROM assignment_submissions WHERE student_id = :student_id
       )",
    [
        ':subject_id' => $subject_id,
        ':student_id' => $student['student_id']
    ]
)->fetchAll();

// ✅ Render view
view('/student/assignments/index.view.php', [
    'heading'               => 'assignments',
    'subject'               => $subject,
    'submittedAssignments'   => $submittedAssignments,
    'notSubmittedAssignments'=> $notSubmittedAssignments
]);
