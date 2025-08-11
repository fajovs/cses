<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$submissionId = $_POST['submission-id'];
$totalScore =  $_POST['total-score'];
$feedback = $_POST['feedback'];


// Validate activity and ownership
$submission = $db->query(
    "SELECT acs.*, a.* FROM activity_submissions acs
     LEFT JOIN activities a ON acs.activity_id = a.activity_id
     WHERE submission_id = :submission_id",
    [':submission_id' => $submissionId]
)->fetch();

if (!$submission) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

$subject = $db->query(
    "SELECT s.*, ps.* 
     FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $submission['subject_id']]
)->fetch();

if (!$subject || $user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}


try {


    $db->query(
        "UPDATE activity_submissions 
         SET feedback = :feedback, total_score = :total_score , is_checked = 1
         WHERE submission_id = :submission_id",
        [
            ':feedback' => $feedback,
            ':total_score' => $totalScore,
            ':submission_id' => $submissionId,
        ]
    );




    $_SESSION['success'] = 'Student Activity Evaluated  successfully!';
} catch (Exception $e) {
   
    $_SESSION['error'] = 'Failed to Evaluate Student Activity: ' . $e->getMessage();
}

header('Location: ' . base_url('/faculty/submissions/subject/' . $subject['subject_id'] . '/activity/' . $submission['activity_id']));
exit;
