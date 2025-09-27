<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$assignment_id = $params['aid'];

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

$assignment = $db->query(
    "SELECT a.*, COUNT(DISTINCT acs.submission_id) AS submitted_count
     FROM assignments a
     LEFT JOIN assignment_submissions acs ON a.assignment_id = acs.assignment_id
     WHERE a.assignment_id = :assignment_id
     GROUP BY a.assignment_id",
    [':assignment_id' => $assignment_id]
)->fetch();

$criterias = $db->query(
    "SELECT * FROM assignment_criteria WHERE assignment_id = :assignment_id",
    [':assignment_id' => $assignment_id]
)->fetchAll();




$submissions = $db->query(
    "SELECT acs.*, 
            CONCAT(s.student_number, ' - ' ,u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS full_name
     FROM assignment_submissions acs
     LEFT JOIN students s ON acs.student_id = s.student_id     
     LEFT JOIN users u ON u.user_id = s.user_id
    
     WHERE acs.assignment_id = :assignment_id
     ORDER BY acs.is_checked ASC, acs.submitted_at DESC",
    [':assignment_id' => $assignment_id]
)->fetchAll();

// ✅ Separate into checked & unchecked
$unchecked_submissions = array_filter($submissions, fn($sub) => !$sub['is_checked']);
$checked_submissions   = array_filter($submissions, fn($sub) => $sub['is_checked']);

// Pass to view
view('/faculty/submissions/assignments/submissions.view.php', [
    'heading'               => 'Submissions',
    'subject'               => $subject,
    'assignment'              => $assignment,
    'unchecked_submissions' => $unchecked_submissions,
    'checked_submissions'   => $checked_submissions,
    'criterias'             => $criterias
]);
