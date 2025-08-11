<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);



$quiz_id = $_POST['quiz_id'];
$status = $_POST['status'];

// Fetch quiz and related data
$quiz = $db->query(
    "SELECT * FROM quizzes WHERE quiz_id = :quiz_id",
    [':quiz_id' => $quiz_id]
)->fetch();



if (!$quiz) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Check ownership
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();




// Fetch subject (to show in header)
$subject = $db->query(
    "SELECT s.*, ps.* FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $quiz['subject_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}





try {


    // Update quiz info
    $db->query(
        "UPDATE quizzes 
             SET is_active = :status
             WHERE quiz_id = :quiz_id",
        [
            ':status' => $status,
            ':quiz_id' => $quiz_id
        ]
    );

   

    // Redirect back after saving
    $_SESSION['success'] = 'Quiz status updated successfully!';

} catch (Exception $e) {

  

    $_SESSION['error'] = 'Failed to update quiz status. Please try again.';
}

header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/quizzes'));
exit;
