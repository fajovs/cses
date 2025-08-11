<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$exam_id = $params['eid'];

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

// Fetch exam for this subject
$exam = $db->query(
    "SELECT * FROM examinations WHERE exam_id = :exam_id",
    [':exam_id' => $exam_id]
)->fetch();

$questions = [];

if (!$exam) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
} else {
    $questions = $db->query(
        "SELECT * FROM exam_questions WHERE exam_id = :exam_id",
        [':exam_id' => $exam_id]
    )->fetchAll();
}

view('/faculty/exams/edit.view.php', [
    'heading'   => 'Exam Details',
    'exam'      => $exam,
    'subject'   => $subject,
    'questions' => $questions
]);
