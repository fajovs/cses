<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$parent_id = $_POST['parent_id'] ?? null;
$student_ids = $_POST['student_id'] ?? [];

if (!$parent_id) {
    $_SESSION['error'] = 'Parent must be selected.';
    header('Location: ' . base_url('/admin/users/parents'));
    exit;
}

try {
    $db->beginTransaction();

    // Get existing links for the parent
    $existingLinks = $db->query(
        "SELECT student_id FROM links WHERE parent_id = :parent_id",
        [':parent_id' => $parent_id]
    )->fetchAll(PDO::FETCH_COLUMN);

    // Convert to array of ints (to ensure type match)
    $existing = array_map('intval', $existingLinks);
    $incoming = array_map('intval', $student_ids);

    // Students to ADD (in $incoming but not in $existing)
    $toAdd = array_diff($incoming, $existing);

    // Students to DELETE (in $existing but not in $incoming)
    $toDelete = array_diff($existing, $incoming);

    // Add new links
    foreach ($toAdd as $student_id) {
        $db->query(
            "INSERT INTO links (parent_id, student_id) VALUES (:parent_id, :student_id)",
            [
                ':parent_id' => $parent_id,
                ':student_id' => $student_id
            ]
        );
    }

    // Remove unlinked students
    foreach ($toDelete as $student_id) {
        $db->query(
            "DELETE FROM links WHERE parent_id = :parent_id AND student_id = :student_id",
            [
                ':parent_id' => $parent_id,
                ':student_id' => $student_id
            ]
        );
    }

    $db->commit();
    $_SESSION['success'] = 'Student links updated successfully!';
} catch (Exception $e) {
    $db->rollback();
    $_SESSION['error'] = 'Failed to update student links: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/users/parents'));
exit;
