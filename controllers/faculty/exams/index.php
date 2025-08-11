<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];

// Fetch subject & section
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

// Check faculty ownership
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// ✅ Fetch active exams
$activeExams = $db->query(
    "SELECT *
     FROM examinations
     WHERE subject_id = :subject_id AND is_active = 1
     ORDER BY created_at DESC",
    [':subject_id' => $subject_id]
)->fetchAll();

// ✅ Fetch inactive exams
$inactiveExams = $db->query(
    "SELECT *
     FROM examinations
     WHERE subject_id = :subject_id AND is_active = 0
     ORDER BY created_at DESC",
    [':subject_id' => $subject_id]
)->fetchAll();

view('/faculty/exams/index.view.php', [
    'heading' => 'Exams',
    'subject' => $subject,
    'activeExams' => $activeExams,
    'inactiveExams' => $inactiveExams
]);
