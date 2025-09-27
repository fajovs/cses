<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$project_id = $params['aid'];  // changed from eid to aid for project_id

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

// Fetch the project by project_id, confirm it belongs to the subject and is within deadline
$project = $db->query(
    "SELECT * FROM projects 
     WHERE project_id = :project_id AND subject_id = :subject_id AND deadline >= NOW()",
    [
        ':project_id' => $project_id,
        ':subject_id' => $subject_id
    ]
)->fetch();

if (!$project) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Check if the student has already submitted the project
$existingSubmission = $db->query(
    "SELECT * FROM project_submissions
     WHERE project_id = :project_id AND student_id = :student_id LIMIT 1",
    [
        ':project_id' => $project_id,
        ':student_id' => $user['student_id']
    ]
)->fetch();

if ($existingSubmission) {
    $_SESSION['error'] = 'You have already submitted this project.';
    header('Location: ' . base_url('/student/subject/' . $subject_id . '/projects'));
    exit;
}

// Fetch project criteria
$criteria = $db->query(
    "SELECT * FROM project_criteria 
     WHERE project_id = :project_id 
     ORDER BY criteria_id ASC",
    [':project_id' => $project_id]
)->fetchAll();

// Show project submission form view
view('/student/projects/project.view.php', [
    'heading'   => 'Submit project',
    'subject'   => $subject,
    'project'  => $project,
    'criteria'  => $criteria
]);
