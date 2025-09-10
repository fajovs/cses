<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$userId = $_SESSION['user_id'];
$quizId = $_POST['quiz_id'];

// Fetch quiz duration
$quiz = $db->query("SELECT * FROM quizzes WHERE quiz_id = ?", [$quizId])->fetch();

$student = $db->query("SELECT * FROM students WHERE user_id = ?", [$userId])->fetch();


$durationMinutes = (int)$quiz['duration'] ?: 60; // default 60 if not set
$endTime = date("Y-m-d H:i:s", strtotime("+$durationMinutes minutes"));

// Check if already started
$attempt = $db->query(
    "SELECT * FROM student_quiz_attempts WHERE student_id = ? AND quiz_id = ? ORDER BY student_quiz_attempt_id DESC LIMIT 1",
    [$userId, $quizId]
)->fetch();

if (!$attempt) {
    // First attempt -> create new record
    $db->query(
        "INSERT INTO student_quiz_attempts (quiz_id, student_id, start_time, end_time, status) 
         VALUES (?, ?, NOW(), ?, 'in_progress')",
        [$quizId, $student['student_id'], $endTime]
    );
} 

header("Location: ". base_url('/student/subject/' . $quiz['subject_id'] . '/quiz/' . $quiz['quiz_id']));

