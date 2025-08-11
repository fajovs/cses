<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];

// Fetch subject and section info
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

// Fetch logged-in faculty user
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

// Ensure this faculty owns the subject
if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

$faculty_id = $user['faculty_id'];

// Pass data to exams create view
view('/faculty/activities/create.view.php', [
    'heading' => 'Activities',
    'subject' => $subject
]);
