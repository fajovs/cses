<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);

$subjectId = $_POST['subject_id'] ?? null;

if (!$subjectId) {
    $_SESSION['error'] = 'subject ID is missing.';
    header('Location: ' . base_url('/admin/subjects'));
    exit;
}

try {
    $stmt = $db->query(
        'DELETE FROM subject WHERE subject_id = :s_id',
        ['s_id' => $subjectId]
    );

    

    if ($stmt->rowCount() > 0) {
        $_SESSION['success'] = 'Subject deleted successfully!';
    } else {
        $_SESSION['error'] = 'Deletion ran but no rows were affected. program may not exist.';
    }
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to delete subject: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/subjects'));
die();
