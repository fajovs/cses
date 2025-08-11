<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id   = $_POST['subject_id'] ?? null;
$activity_id  = $_POST['activity_id'] ?? null;
$notes        = $_POST['note'] ?? null;
$file         = $_FILES['file'] ?? null;

if (!$subject_id || !$activity_id) {
    http_response_code(400);
    $_SESSION['error'] = 'Missing activity or subject information.';
    header('Location: ' . base_url('/student/subjects'));
    exit;
}

// Fetch logged-in student
$user = $db->query(
    "SELECT * FROM students WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

// Fetch subject & section
$subject = $db->query(
    "SELECT s.*, ps.* 
     FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $subject_id]
)->fetch();

if (!$subject) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Validate student is in correct section
if ($subject['section_id'] != $user['section_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Prepare file name if file is present
$file_path = null;
$temp_path = null;
$filename = null;

if ($file && $file['error'] === UPLOAD_ERR_OK) {
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $timestamp = time();
    $filename = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $originalName)) . "_$timestamp." . $extension;

    // Set relative path for DB
    $file_path = 'uploads/' . $filename;

    // Store the file temporarily, move after DB insert
    $temp_path = $file['tmp_name'];
}

try {
  
    $db->query(
        "INSERT INTO activity_submissions (
            activity_id, student_id, file_path, notes, is_checked
        ) VALUES (
            :activity_id, :student_id, :file_path, :notes, 0
        )",
        [
            ':activity_id' => $activity_id,
            ':student_id'  => $user['student_id'],
            ':file_path'   => $filename,
            ':notes'       => $notes
        ]
    );

    // If file exists, move it after DB insert
    if ($temp_path && $file_path) {
        $uploadPath = base_path('public/' . $file_path);
        if (!move_uploaded_file($temp_path, $uploadPath)) {
            $_SESSION['error'] = 'Database saved, but file upload failed.';
            header('Location: ' . base_url("/student/subject/$subject_id/activity/$activity_id"));
            exit;
        }
    }

    $_SESSION['success'] = "Activity submitted successfully.";
} catch (Exception $e) {
    $_SESSION['error'] = 'Submission failed: ' . $e->getMessage();
}

header('Location: ' . base_url("/student/subject/$subject_id/activity/$activity_id"));
exit;
