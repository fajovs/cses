<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$userId = $_SESSION['user_id'];
$examId = $_POST['exam_id'];

// Fetch exam duration
$exam = $db->query("SELECT * FROM examinations WHERE exam_id = ?", [$examId])->fetch();

$student = $db->query("SELECT * FROM students WHERE user_id = ?", [$userId])->fetch();


$durationMinutes = (int)$exam['duration'] ?: 60; // default 60 if not set
$endTime = date("Y-m-d H:i:s", strtotime("+$durationMinutes minutes"));

// Check if already started
$attempt = $db->query(
    "SELECT * FROM student_exam_attempts WHERE student_id = ? AND exam_id = ? ORDER BY student_exam_attempt_id DESC LIMIT 1",
    [$userId, $examId]
)->fetch();

if (!$attempt) {
    // First attempt -> create new record
    $db->query(
        "INSERT INTO student_exam_attempts (exam_id, student_id, start_time, end_time, status) 
         VALUES (?, ?, NOW(), ?, 'in_progress')",
        [$examId, $student['student_id'], $endTime]
    );
} 

header("Location: ". base_url('/student/subject/' . $exam['subject_id'] . '/exam/' . $exam['exam_id']));

