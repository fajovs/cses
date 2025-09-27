<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];

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

$assignments = $db->query(
    "SELECT a.*, COUNT(DISTINCT acs.submission_id) AS submitted_count
     FROM assignments a
     LEFT JOIN assignment_submissions acs ON a.assignment_id = acs.assignment_id
     WHERE a.subject_id = :subject_id
     GROUP BY a.assignment_id
     ORDER BY a.is_active DESC, a.created_at DESC",
    [':subject_id' => $subject_id]
)->fetchAll();



// ✅ Pass to the view
view('/faculty/submissions/assignments/assignments.view.php', [
    'heading' => 'Submissions',
    'subject' => $subject,
    'assignments' => $assignments,
]);
