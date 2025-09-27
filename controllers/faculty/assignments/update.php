<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$assignment_id = $params['aid'];

// Validate assignment and ownership
$assignment = $db->query(
    "SELECT * FROM assignments WHERE assignment_id = :assignment_id",
    [':assignment_id' => $assignment_id]
)->fetch();

if (!$assignment) {
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
    [':subject_id' => $assignment['subject_id']]
)->fetch();

if (!$subject || $user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// Handle POST data
$title = $_POST['title'];
$description = $_POST['description'];
$deadline = $_POST['deadline'];
$criteria_names = $_POST['criteria_name'] ?? [];
$criteria_weights = $_POST['criteria_weight'] ?? [];
$criteria_ids = $_POST['criteria_id'] ?? [];

// Keep old file info by default
$file_path = $assignment['file_path'];
$file_name = $assignment['file_name'];

// Check if a new file is uploaded
$file = $_FILES['file'] ?? null;
$temp_path = null;
$new_file_uploaded = false;

if ($file && $file['error'] === UPLOAD_ERR_OK) {
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $timestamp = time();
    $filename = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $originalName)) . "_$timestamp." . $extension;

    // Update with new file info
    $file_path = 'uploads/' . $filename;
    $file_name = $file['name']; // store the original filename

    $temp_path = $file['tmp_name'];
    $new_file_uploaded = true;
}

try {
    $db->beginTransaction();

    // Update the assignment info
    $db->query(
        "UPDATE assignments 
         SET title = :title, description = :description, deadline = :deadline, 
             file_path = :file_path, file_name = :file_name
         WHERE assignment_id = :assignment_id",
        [
            ':title' => $title,
            ':description' => $description,
            ':deadline' => $deadline,
            ':file_path' => $file_path,
            ':file_name' => $file_name,
            ':assignment_id' => $assignment_id
        ]
    );

    // Get existing criteria
    $existing_criteria = $db->query(
        "SELECT * FROM assignment_criteria WHERE assignment_id = :assignment_id",
        [':assignment_id' => $assignment_id]
    )->fetchAll();

    $existing_ids = array_column($existing_criteria, 'criteria_id');
    $new_ids = [];

    foreach ($criteria_names as $index => $name) {
        $weight = $criteria_weights[$index] ?? 0;
        $criteria_id = $criteria_ids[$index] ?? null;

        if ($criteria_id && in_array($criteria_id, $existing_ids)) {
            $db->query(
                "UPDATE assignment_criteria 
                 SET criteria_name = :name, weight = :weight 
                 WHERE criteria_id = :criteria_id",
                [
                    ':name' => $name,
                    ':weight' => $weight,
                    ':criteria_id' => $criteria_id
                ]
            );
            $new_ids[] = $criteria_id;
        } else {
            $db->query(
                "INSERT INTO assignment_criteria (assignment_id, criteria_name, weight)
                 VALUES (:assignment_id, :name, :weight)",
                [
                    ':assignment_id' => $assignment_id,
                    ':name' => $name,
                    ':weight' => $weight
                ]
            );
            $new_ids[] = $db->lastInsertId();
        }
    }

    // Delete removed criteria
    foreach ($existing_ids as $existing_id) {
        if (!in_array($existing_id, $new_ids)) {
            $db->query(
                "DELETE FROM assignment_criteria WHERE criteria_id = :criteria_id",
                [':criteria_id' => $existing_id]
            );
        }
    }

    // Commit database changes
    $db->commit();

    // ✅ Move the uploaded file if a new one exists
    if ($new_file_uploaded && $temp_path) {
        $upload_dir = base_path('public/uploads/');
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Optional: delete old file if exists
        if ($assignment['file_path'] && file_exists(base_path('public/' . $assignment['file_path']))) {
            unlink(base_path('public/' . $assignment['file_path']));
        }

        move_uploaded_file($temp_path, $upload_dir . basename($file_path));
    }

    $_SESSION['success'] = 'Assignment updated successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to update Assignment: ' . $e->getMessage();
}

header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/assignments'));
exit;
