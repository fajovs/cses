<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$student_id = $params['sid'];
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



$subjects = $db->query(
    "SELECT
        s.*,
        CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS faculty_name,
        ps.section_name
    FROM subjects s
    LEFT JOIN program_sections ps ON s.section_id = ps.section_id
    LEFT JOIN faculties f ON s.faculty_id = f.faculty_id
    LEFT JOIN users u ON f.user_id = u.user_id
    WHERE ps.section_id = :section_id
    GROUP BY s.subject_id",
    [':section_id' => $student['section_id']]
)->fetchAll();





view('/parent/subjects/index.view.php', [
    'heading' => 'Students',
    'subjects' => $subjects,
    'student' => $student,

]);
