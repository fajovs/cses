<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$assignment_id = $params['aid'];

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

// Check if the current user is the faculty of the subject
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Fetch the assignment
$assignment = $db->query(
    "SELECT * FROM assignments WHERE assignment_id = :assignment_id AND subject_id = :subject_id",
    [
        ':assignment_id' => $assignment_id,
        ':subject_id' => $subject_id
    ]
)->fetch();


if (!$assignment) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Fetch assignment criteria
$criterias = $db->query(
    "SELECT * FROM assignment_criteria WHERE assignment_id = :assignment_id",
    [':assignment_id' => $assignment_id]
)->fetchAll();

// Show the view
view('/faculty/assignments/edit.view.php', [
    'heading'   => 'Assignment Details',
    'assignment'  => $assignment,
    'subject'   => $subject,
    'criterias' => $criterias
]);
