<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$submissionId = $_POST['submission-id'];
$feedback = $_POST['feedback'];


// Validate activity and ownership
$submission = $db->query(
    "SELECT sa.*, e.* FROM student_exam_attempts sa
     LEFT JOIN examinations e ON sa.exam_id = e.exam_id
     WHERE student_exam_attempt_id = :submission_id",
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
        "UPDATE student_exam_attempts
         SET feedback = :feedback, is_checked = 1
         WHERE student_exam_attempt_id = :submission_id",
        [
            ':feedback' => $feedback,
            ':submission_id' => $submissionId,
        ]
    );




    $_SESSION['success'] = 'Student Exam Checked  successfully!';
} catch (Exception $e) {
   
    $_SESSION['error'] = 'Failed to Check Student Exam: ' . $e->getMessage();
}

header('Location: ' . base_url('/faculty/submissions/subject/' . $subject['subject_id'] . '/exam/' . $submission['exam_id']));
exit;
