<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);

$programId = $_POST['program_id'] ?? null;

if (!$programId) {
    $_SESSION['error'] = 'program ID is missing.';
    header('Location: ' . base_url('/admin/programs'));
    exit;
}

try {
    $stmt = $db->query(
        'DELETE FROM program WHERE program_id = :dp_id',
        ['dp_id' => $programId]
    );

    if ($stmt->rowCount() > 0) {
        $_SESSION['success'] = 'Program deleted successfully!';
    } else {
        $_SESSION['error'] = 'Deletion ran but no rows were affected. program may not exist.';
    }
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to delete program: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/programs'));
die();
