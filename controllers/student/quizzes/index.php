<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);



$subject_id = $params['id'] ?? null;  // get from query or router
// Or if you prefer, parse from the URL some other way, instead of using $params.

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

// // Ensure student belongs to correct section
// if ($subject['section_id'] != $user['section_id']) {
//     http_response_code(403);
//     require base_path('views/403.view.php');
//     exit;
// }

// ✅ Fetch quizzes the student has already attempted
$attemptedQuizzes = $db->query(
    "SELECT q.*, a.*
     FROM quizzes q
     INNER JOIN student_quiz_attempts a ON q.quiz_id = a.quiz_id
     WHERE q.subject_id = :subject_id 
       AND a.student_id = :student_id
       AND a.status IN ('submitted', 'expired')",
    [
        ':subject_id' => $subject_id,
        ':student_id' => $user['student_id']
    ]
)->fetchAll();

// ✅ Fetch quizzes the student has NOT attempted
$notAttemptedQuizzes = $db->query(
    "SELECT q.*
     FROM quizzes q
     WHERE q.subject_id = :subject_id AND q.is_active = 1
       AND q.quiz_id NOT IN (
           SELECT quiz_id FROM student_quiz_attempts WHERE student_id = :student_id
       )",
    [
        ':subject_id' => $subject_id,
        ':student_id' => $user['student_id']
    ]
)->fetchAll();

$inprogressQuizzes = $db->query(
    "SELECT q.*, a.*
     FROM quizzes q
     INNER JOIN student_quiz_attempts a ON q.quiz_id = a.quiz_id
     WHERE q.subject_id = :subject_id 
       AND a.student_id = :student_id
       AND a.status = 'in_progress'",
    [
        ':subject_id' => $subject_id,
        ':student_id' => $user['student_id']
    ]
)->fetchAll();


// ✅ Pass both lists to view
view('/student/quizzes/index.view.php', [
    'heading'            => 'Quizzes',
    'subject'            => $subject,
    'attemptedQuizzes'   => $attemptedQuizzes,
    'notAttemptedQuizzes'=> $notAttemptedQuizzes,
    'inprogressQuizzes'=> $inprogressQuizzes
]);
