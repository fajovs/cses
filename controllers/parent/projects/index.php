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


$projects = $db->query(
    "SELECT a.*, acs.*
     FROM projects a
     LEFT JOIN project_submissions acs 
        ON a.project_id = acs.project_id 
        AND acs.student_id = :student_id
     WHERE a.subject_id = :subject_id 
     ORDER BY a.created_at DESC",
    [':student_id' => $student_id,':subject_id' => $subject_id]
)->fetchAll();




// ✅ Pass to the view
view('/parent/projects/index.view.php', [
    'heading' => 'projects',
    'subject' => $subject,
    'projects' => $projects,
    'student' => $student,
    
]);
