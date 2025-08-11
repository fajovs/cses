<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'] ?? null;

if (!$subject_id) {
    http_response_code(400);
    die('Subject ID is required.');
}

// Fetch logged-in student
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

// Ensure student belongs to correct section
if ($subject['section_id'] != $user['section_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// ✅ Fetch exams the student has already attempted
$attemptedExams = $db->query(
    "SELECT e.*, a.*
     FROM examinations e
     INNER JOIN student_exam_attempts a ON e.exam_id = a.exam_id
     WHERE e.subject_id = :subject_id AND a.student_id = :student_id",
    [
        ':subject_id' => $subject_id,
        ':student_id' => $user['student_id']
    ]
)->fetchAll();

// ✅ Fetch exams the student has NOT attempted
$notAttemptedExams = $db->query(
    "SELECT e.*
     FROM examinations e
     WHERE e.subject_id = :subject_id AND e.is_active = 1
       AND e.exam_id NOT IN (
           SELECT exam_id FROM student_exam_attempts WHERE student_id = :student_id
       )",
    [
        ':subject_id' => $subject_id,
        ':student_id' => $user['student_id']
    ]
)->fetchAll();

// ✅ Pass both lists to view
view('/student/exams/index.view.php', [
    'heading'            => 'Exams',
    'subject'            => $subject,
    'attemptedExams'     => $attemptedExams,
    'notAttemptedExams'  => $notAttemptedExams
]);
