<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);



$quiz_id = $_POST['quiz_id'];

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

// Fetch quiz questions
$questions = $db->query(
    "SELECT * FROM quiz_questions WHERE quiz_id = :quiz_id",
    [':quiz_id' => $quiz_id]
)->fetchAll();


try {


    $db->query(
        'DELETE FROM quizzes WHERE quiz_id = :quiz_id',
        [':quiz_id' => $quiz_id]
    );



    // Redirect back after saving
    $_SESSION['success'] = 'Quiz deleted successfully!';
} catch (Exception $e) {

    // Log error or show message (keep it simple here)
    $_SESSION['error'] = 'Failed to delete quiz. Please try again.';
}

header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/quizzes'));
exit;
