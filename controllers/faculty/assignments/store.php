<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $_POST['subject_id'];

// Fetch subject
$subject = $db->query(
    "SELECT s.*, ps.* FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE subject_id = :subject_id",
    [':subject_id' => $subject_id]
)->fetch();

if (!$subject) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// Validate faculty access
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Form values
$title            = $_POST['title'];
$description      = $_POST['description'];
$deadline         = $_POST['deadline'];
$criteria_names   = $_POST['criteria_name'] ?? [];
$criteria_weights = $_POST['criteria_weight'] ?? [];
$file             = $_FILES['file'] ?? null;

$file_path = null;
$filename  = null;
$temp_path = null;

if ($file && $file['error'] === UPLOAD_ERR_OK) {
    $originalName   = $file['name'];
    $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
    $extension      = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $timestamp      = time();

    // ✅ Validate allowed extensions
    $allowed = ['pdf', 'png', 'jpg', 'jpeg'];
    if (!in_array($extension, $allowed)) {
        $_SESSION['error'] = "Invalid file type. Allowed: PDF, PNG, JPG, JPEG.";
        header('Location: ' . base_url('/faculty/subject/' . $subject_id . '/assignments/create'));
        exit;
    }

    // ✅ Validate file size (e.g., 5MB max)
    if ($file['size'] > 5 * 1024 * 1024) {
        $_SESSION['error'] = "File too large. Max size is 5MB.";
        header('Location: ' . base_url('/faculty/subject/' . $subject_id . '/assignments/create'));
        exit;
    }

    // ✅ Generate safe filename
    $safeName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $nameWithoutExt));
    $filename = $safeName . "_" . $timestamp . "." . $extension;

    // Save relative path for DB
    $file_path = 'uploads/' . $filename;
    $temp_path = $file['tmp_name'];
}

try {
    $db->beginTransaction();

    // Insert into assignments
    $db->query(
        "INSERT INTO assignments (subject_id, title, description, deadline, is_active, file_path, file_name)
         VALUES (:subject_id, :title, :description, :deadline, 1, :file_path, :file_name)",
        [
            ':subject_id' => $subject_id,
            ':title'      => $title,
            ':description'=> $description,
            ':deadline'   => $deadline,
            ':file_path'  => $file_path,   // relative path
            ':file_name'  => $filename,    // actual filename
        ]
    );

    $assignment_id = $db->lastInsertId();

    // Insert criteria
    foreach ($criteria_names as $index => $name) {
        $weight = $criteria_weights[$index] ?? 0;

        $db->query(
            "INSERT INTO assignment_criteria (assignment_id, criteria_name, weight)
             VALUES (:assignment_id, :name, :weight)",
            [
                ':assignment_id' => $assignment_id,
                ':name'        => $name,
                ':weight'      => $weight
            ]
        );
    }

    // Move uploaded file if exists
    if ($temp_path && $file_path) {
        $uploadPath = base_path('public/' . $file_path);
        if (!move_uploaded_file($temp_path, $uploadPath)) {
            throw new Exception('Database saved, but file upload failed.');
        }
    }

    $db->commit();
    $_SESSION['success'] = 'Assignment created successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to create Assignment: ' . $e->getMessage();
}

header('Location: ' . base_url('/faculty/subject/' . $subject_id . '/assignments'));
exit;
