<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $params['id'];
$exam_id = $params['eid'];

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

$exam = $db->query(
    "SELECT e.*, COUNT(DISTINCT sa.student_exam_attempt_id) AS submitted_count
     FROM examinations e
     LEFT JOIN student_exam_attempts sa ON e.exam_id = sa.exam_id
     WHERE e.exam_id = :exam_id
     GROUP BY e.exam_id",
    [':exam_id' => $exam_id]
)->fetch();




$submissions = $db->query(
    "SELECT sa.*, 
            CONCAT(s.student_number, ' - ' ,u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS full_name
     FROM student_exam_attempts sa
     LEFT JOIN students s ON sa.student_id = s.student_id     
     LEFT JOIN users u ON u.user_id = s.user_id
     WHERE sa.exam_id = :exam_id
     ORDER BY sa.is_checked ASC, sa.submitted_at DESC",
    [':exam_id' => $exam_id]
)->fetchAll();

// ✅ Separate into checked & unchecked
$unchecked_submissions = array_filter($submissions, fn($sub) => !$sub['is_checked']);
$checked_submissions   = array_filter($submissions, fn($sub) => $sub['is_checked']);

// Pass to view
view('/faculty/submissions/examinations/submissions.view.php', [
    'heading'               => 'Submissions',
    'subject'               => $subject,
    'exam'              => $exam,
    'unchecked_submissions' => $unchecked_submissions,
    'checked_submissions'   => $checked_submissions,
]);
