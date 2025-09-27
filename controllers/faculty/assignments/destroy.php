<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$assignment_id = $_POST['assignment_id'];

// ✅ Fetch the assignment and its subject
$assignment = $db->query(
    "SELECT * FROM assignments WHERE assignment_id = :assignment_id",
    [':assignment_id' => $assignment_id]
)->fetch();

if (!$assignment) {
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
    [':subject_id' => $assignment['subject_id']]
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

    // ✅ Delete criteria linked to the assignment
    $db->query(
        "DELETE FROM assignment_criteria WHERE assignment_id = :assignment_id",
        [':assignment_id' => $assignment_id]
    );

    // ✅ Delete the assignment itself
    $db->query(
        "DELETE FROM assignments WHERE assignment_id = :assignment_id",
        [':assignment_id' => $assignment_id]
    );

    $db->commit();
    $_SESSION['success'] = 'assignment deleted successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to delete assignment: ' . $e->getMessage();
}

// ✅ Redirect back to assignment list
header('Location: ' . base_url('/faculty/subject/' . $subject['subject_id'] . '/assignments'));
exit;
