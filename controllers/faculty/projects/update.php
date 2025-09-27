<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$project_id = $params['aid'];

// Validate project and ownership
$project = $db->query(
    "SELECT * FROM projects WHERE project_id = :project_id",
    [':project_id' => $project_id]
)->fetch();

if (!$project) {
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
    [':subject_id' => $project['subject_id']]
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
$file_path = $project['file_path'];
$file_name = $project['file_name'];

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

    // Update the project info
    $db->query(
        "UPDATE projects 
         SET title = :title, description = :description, deadline = :deadline, 
             file_path = :file_path, file_name = :file_name
         WHERE project_id = :project_id",
        [
            ':title' => $title,
            ':description' => $description,
            ':deadline' => $deadline,
            ':file_path' => $file_path,
            ':file_name' => $file_name,
            ':project_id' => $project_id
        ]
    );

    // Get existing criteria
    $existing_criteria = $db->query(
        "SELECT * FROM project_criteria WHERE project_id = :project_id",
        [':project_id' => $project_id]
    )->fetchAll();

    $existing_ids = array_column($existing_criteria, 'criteria_id');
    $new_ids = [];

    foreach ($criteria_names as $index => $name) {
        $weight = $criteria_weights[$index] ?? 0;
        $criteria_id = $criteria_ids[$index] ?? null;

        if ($criteria_id && in_array($criteria_id, $existing_ids)) {
            $db->query(
                "UPDATE project_criteria 
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
                "INSERT INTO project_criteria (project_id, criteria_name, weight)
                 VALUES (:project_id, :name, :weight)",
                [
                    ':project_id' => $project_id,
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
                "DELETE FROM project_criteria WHERE criteria_id = :criteria_id",
                [':criteria_id' => $existing_id]
            );
        }
    }

    // Commit DB changes
    $db->commit();

    // ✅ Move uploaded file if a new one exists
    if ($new_file_uploaded && $temp_path) {
        $upload_dir = base_path('public/uploads/');
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Optional: delete old file if exists
        if ($project['file_path'] && file_exists(base_path('public/' . $project['file_path']))) {
            unlink(base_path('public/' . $project['file_path']));
        }

        move_uploaded_file($temp_path, $upload_dir . basename($file_path));
    }

    $_SESSION['success'] = 'Project updated successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to update Project: ' . $e->getMessage();
}

header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/projects'));
exit;
