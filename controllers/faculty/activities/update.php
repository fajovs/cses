<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$activity_id = $params['aid'];

// Validate activity and ownership
$activity = $db->query(
    "SELECT * FROM activities WHERE activity_id = :activity_id",
    [':activity_id' => $activity_id]
)->fetch();

if (!$activity) {
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
    [':subject_id' => $activity['subject_id']]
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
$criteria_ids = $_POST['criteria_id'] ?? []; // hidden inputs if existing

try {
    $db->beginTransaction();

    // Update the activity info
    $db->query(
        "UPDATE activities SET title = :title, description = :description, deadline = :deadline WHERE activity_id = :activity_id",
        [
            ':title' => $title,
            ':description' => $description,
            ':deadline' => $deadline,
            ':activity_id' => $activity_id
        ]
    );

    // Get existing criteria from DB
    $existing_criteria = $db->query(
        "SELECT * FROM activity_criteria WHERE activity_id = :activity_id",
        [':activity_id' => $activity_id]
    )->fetchAll();

    $existing_ids = array_column($existing_criteria, 'criteria_id');
    $new_ids = [];

    foreach ($criteria_names as $index => $name) {
        $weight = $criteria_weights[$index] ?? 0;
        $criteria_id = $criteria_ids[$index] ?? null;

        if ($criteria_id && in_array($criteria_id, $existing_ids)) {
            // Update existing criterion
            $db->query(
                "UPDATE activity_criteria SET criteria_name = :name, weight = :weight WHERE criteria_id = :criteria_id",
                [
                    ':name' => $name,
                    ':weight' => $weight,
                    ':criteria_id' => $criteria_id
                ]
            );
            $new_ids[] = $criteria_id;
        } else {
            // Insert new criterion
            $db->query(
                "INSERT INTO activity_criteria (activity_id, criteria_name, weight)
                 VALUES (:activity_id, :name, :weight)",
                [
                    ':activity_id' => $activity_id,
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
                "DELETE FROM activity_criteria WHERE criteria_id = :criteria_id",
                [':criteria_id' => $existing_id]
            );
        }
    }

    $db->commit();
    $_SESSION['success'] = 'Activity updated successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to update activity: ' . $e->getMessage();
}

header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/activities'));
exit;
