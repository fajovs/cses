<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$exam_id    = $params['eid'];  // changed from qid → eid

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

// Fetch the exam by exam_id, confirm it belongs to the subject and is active
$exam = $db->query(
    "SELECT * FROM examinations 
     WHERE exam_id = :exam_id AND subject_id = :subject_id AND is_active = 1",
    [
        ':exam_id' => $exam_id,
        ':subject_id' => $subject_id
    ]
)->fetch();

if (!$exam) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Check if the student has already taken the exam
$existingAttempt = $db->query(
    "SELECT * FROM student_exam_attempts
     WHERE exam_id = :exam_id AND status = 'in_progress' AND student_id = :student_id LIMIT 1",
    [
        ':exam_id' => $exam_id,
        ':student_id' => $user['student_id']
    ]
)->fetch();


// Fetch exam questions
$questions = $db->query(
    "SELECT * FROM exam_questions WHERE exam_id = :exam_id ORDER BY exam_question_id ASC",
    [':exam_id' => $exam_id]
)->fetchAll();

// Show exam answer view
view('/student/exams/exam.view.php', [
    'heading'   => 'Take Exam',
    'subject'   => $subject,
    'exam'      => $exam,
    'questions' => $questions,
    'existingAttempt' => $existingAttempt
]);
