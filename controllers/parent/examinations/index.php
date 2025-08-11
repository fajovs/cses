<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$student_id = $params['sid'];
$subject_id = $params['suid'];

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

$user = $db->query(
    "SELECT * FROM parents WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

$student =$db->query(
    "SELECT s.*,
     CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS student_name
     FROM students s
     LEFT JOIN users u ON s.user_id = u.user_id
     WHERE s.student_id = :student_id",
    [':student_id' => $student_id]
)->fetch();

$link = $db->query(
    "SELECT * FROM links WHERE student_id = :student_id",
    [':student_id' => $student_id]
)->fetch();


if (!$link) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

if ($link['parent_id'] != $user['parent_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}


$exams = $db->query(
    "SELECT e.*, sa.*
     FROM examinations e
     LEFT JOIN student_exam_attempts sa
        ON e.exam_id = sa.exam_id 
        AND sa.student_id = :student_id
     WHERE e.subject_id = :subject_id 
     ORDER BY e.created_at DESC",
    [':student_id' => $student_id,':subject_id' => $subject_id]
)->fetchAll();




// ✅ Pass to the view
view('/parent/examinations/index.view.php', [
    'heading' => 'exams',
    'subject' => $subject,
    'exams' => $exams,
    'student' => $student,
    
]);
