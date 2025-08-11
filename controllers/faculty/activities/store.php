<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $_POST['subject_id'];

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

$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

$title = $_POST['title'];
$description = $_POST['description'];
$deadline = $_POST['deadline'];
$criteria_names = $_POST['criteria_name'] ?? [];
$criteria_weights = $_POST['criteria_weight'] ?? [];

try {
    $db->beginTransaction();

    // Insert into activities table
    $db->query(
        "INSERT INTO activities (subject_id, title, description, deadline, is_active)
         VALUES (:subject_id, :title, :description, :deadline, 1)",
        [
            ':subject_id' => $subject_id,
            ':title' => $title,
            ':description' => $description,
            ':deadline' => $deadline
        ]
    );

    $activity_id = $db->lastInsertId();

    // Insert criteria
    foreach ($criteria_names as $index => $name) {
        $weight = $criteria_weights[$index] ?? 0;

        $db->query(
            "INSERT INTO activity_criteria (activity_id, criteria_name, weight)
             VALUES (:activity_id, :name, :weight)",
            [
                ':activity_id' => $activity_id,
                ':name' => $name,
                ':weight' => $weight
            ]
        );
    }

    $db->commit();
    $_SESSION['success'] = 'Activity created successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to create Activity: ' . $e->getMessage();
}

header('Location: ' . base_url('/faculty/subject/' . $subject_id . '/activities'));
exit;
