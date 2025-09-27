<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$project_id = $_POST['project_id'];

// ✅ Fetch the project and its subject
$project = $db->query(
    "SELECT * FROM projects WHERE project_id = :project_id",
    [':project_id' => $project_id]
)->fetch();

if (!$project) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Fetch the related subject
$subject = $db->query(
    "SELECT s.*, ps.*
     FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $project['subject_id']]
)->fetch();

if (!$subject) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

// ✅ Validate that the logged-in user is the owner
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

if ($user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

try {
    $db->beginTransaction();

    // ✅ Delete criteria linked to the project
    $db->query(
        "DELETE FROM project_criteria WHERE project_id = :project_id",
        [':project_id' => $project_id]
    );

    // ✅ Delete the project itself
    $db->query(
        "DELETE FROM projects WHERE project_id = :project_id",
        [':project_id' => $project_id]
    );

    $db->commit();
    $_SESSION['success'] = 'Project deleted successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to delete Project: ' . $e->getMessage();
}

// ✅ Redirect back to project list
header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/projects'));
exit;
