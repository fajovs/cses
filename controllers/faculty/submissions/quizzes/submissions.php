<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$quiz_id = $params['qid'];

// ✅ Fetch subject & section
$subject = $db->query(
    "SELECT s.*, ps.*
     FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE subject_id = :subject_id",
    [':subject_id' => $subject_id]
)->fetch();

if (!$subject) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Check if current user is the faculty for this subject
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

$quiz = $db->query(
    "SELECT q.*, COUNT(DISTINCT sa.student_quiz_attempt_id) AS submitted_count
     FROM quizzes q
     LEFT JOIN student_quiz_attempts sa ON q.quiz_id = sa.quiz_id
     WHERE q.quiz_id = :quiz_id
     GROUP BY q.quiz_id",
    [':quiz_id' => $quiz_id]
)->fetch();




$submissions = $db->query(
    "SELECT sa.*, 
            CONCAT(s.student_number, ' - ' ,u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS full_name
     FROM student_quiz_attempts sa
     LEFT JOIN students s ON sa.student_id = s.student_id     
     LEFT JOIN users u ON u.user_id = s.user_id
     WHERE sa.quiz_id = :quiz_id
     ORDER BY sa.is_checked ASC, sa.submitted_at DESC",
    [':quiz_id' => $quiz_id]
)->fetchAll();

// ✅ Separate into checked & unchecked
$unchecked_submissions = array_filter($submissions, fn($sub) => !$sub['is_checked']);
$checked_submissions   = array_filter($submissions, fn($sub) => $sub['is_checked']);

// Pass to view
view('/faculty/submissions/quizzes/submissions.view.php', [
    'heading'               => 'Submissions',
    'subject'               => $subject,
    'quiz'              => $quiz,
    'unchecked_submissions' => $unchecked_submissions,
    'checked_submissions'   => $checked_submissions,
]);
