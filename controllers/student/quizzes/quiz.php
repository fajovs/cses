<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$quiz_id    = $params['qid'];

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

// Fetch the quiz by quiz_id, confirm it belongs to the subject and is active
$quiz = $db->query(
    "SELECT * FROM quizzes 
     WHERE quiz_id = :quiz_id AND subject_id = :subject_id AND is_active = 1",
    [
        ':quiz_id' => $quiz_id,
        ':subject_id' => $subject_id
    ]
)->fetch();

if (!$quiz) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Check if the student has already taken the quiz
$existingAttempt = $db->query(
    "SELECT * FROM student_quiz_attempts
     WHERE quiz_id = :quiz_id AND student_id = :student_id LIMIT 1",
    [
        ':quiz_id' => $quiz_id,
        ':student_id' => $user['student_id']
    ]
)->fetch();

if ($existingAttempt) {
    // Already submitted, block access or redirect
    $_SESSION['error'] = 'You have already submitted this quiz.';
    header('Location: ' . base_url('/student/subject/' . $subject_id . '/quizzes'));
    exit;
}

// Fetch quiz questions
$questions = $db->query(
    "SELECT * FROM quiz_questions WHERE quiz_id = :quiz_id ORDER BY quiz_question_id ASC",
    [':quiz_id' => $quiz_id]
)->fetchAll();

// Show quiz answer view
view('/student/quizzes/quiz.view.php', [
    'heading'   => 'Take Quiz',
    'subject'   => $subject,
    'quiz'      => $quiz,
    'questions' => $questions
]);
