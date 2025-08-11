<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$quiz_id = $params['qid'];



// Fetch subject with section info
$subject = $db->query(
    "SELECT s.*, ps.* FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE subject_id = :subject_id",
    [':subject_id' => $subject_id]
)->fetch();

if (!$subject) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Fetch faculty user
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

// Check permission
if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Fetch quiz for this subject
$quiz = $db->query(
    "SELECT * FROM quizzes WHERE quiz_id = :quiz_id",
    [':quiz_id' => $quiz_id]
)->fetch();

$questions = [];

if (!$quiz) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
} else {
    $questions = $db->query(
        "SELECT * FROM quiz_questions WHERE quiz_id = :quiz_id",
        [':quiz_id' => $quiz_id]
    )->fetchAll();
}


view('/faculty/quizzes/edit.view.php', [
    'heading'   => 'Quiz Details',
    'quiz'      => $quiz,
    'subject'   => $subject,
    'questions' => $questions
]);
