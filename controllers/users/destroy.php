<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);

$userId = $_POST['user_id'] ?? null;

if (!$userId) {
    $_SESSION['error'] = 'user ID is missing.';
    header('Location: ' . base_url('/admin/users'));
    exit;
}

try {
    $stmt = $db->query(
        'DELETE FROM users WHERE user_id = :u_id',
        ['u_id' => $userId]
    );

    

    if ($stmt->rowCount() > 0) {
        $_SESSION['success'] = 'User deleted successfully!';
    } else {
        $_SESSION['error'] = 'Deletion ran but no rows were affected. program may not exist.';
    }
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to delete user: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/users'));
die();
