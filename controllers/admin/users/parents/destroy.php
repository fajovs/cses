<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$user_id = $_POST['user_id'] ?? null;

if (!$user_id) {
    $_SESSION['error'] = 'User ID is missing.';
    header('Location: ' . base_url('/admin/users/parents'));
    exit;
}

try {
    // Start transaction
    $db->beginTransaction();

    $user = $db->query(
        "SELECT * FROM parents WHERE user_id = :user_id",
        [':user_id' => $user_id]
    )->fetch();


    $db->query(
        'DELETE FROM links WHERE parent_id = :parent_id',
        [':parent_id' => $user['parent_id']]
    );




    // Delete from faculties first (foreign key depends on users)
    $db->query(
        'DELETE FROM parents WHERE user_id = :user_id',
        [':user_id' => $user_id]
    );

    // Then delete from users
    $db->query(
        'DELETE FROM users WHERE user_id = :user_id',
        [':user_id' => $user_id]
    );





    // Commit transaction if all succeed
    $db->commit();

    $_SESSION['success'] = 'Parent user deleted successfully!';
} catch (Exception $e) {
    // Rollback on failure
    $db->rollBack();
    $_SESSION['error'] = 'Failed to delete Parent user: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/users/parents'));
exit;
