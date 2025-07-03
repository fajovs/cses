<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$user_id = $_POST['user_id'];
$first_name = $_POST['first-name-edit'];
$middle_name = $_POST['middle-name-edit'];
$last_name = $_POST['last-name-edit'];
$suffix = $_POST['suffix-edit'];
$password = $_POST['password-edit'] ?? '';
$email = $_POST['email-edit'];
$program_id = $_POST['program-edit'] ?? null;
$role = $_POST['role-edit'];
$datetime = date('Y-m-d H:i:s');



$passwordChanged = false;

try {
    if (!empty($password)) {
        $passwordChanged = true;
        $hashedPassword = password_hash(trim($password), PASSWORD_DEFAULT);

        $db->query(
            'UPDATE users SET
                email = :email,
                password = :password,
                first_name = :first_name,
                middle_name = :middle_name,
                last_name = :last_name,
                suffix = :suffix,
                role = :role,
                program_id = :program_id,
                updated_at = :updated_at
             WHERE user_id = :user_id',
            [
                'email' => $email,
                'password' => $hashedPassword,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'last_name' => $last_name,
                'suffix' => $suffix,
                'role' => $role,
                'program_id' => $program_id,
                'updated_at' => $datetime,
                'user_id' => $user_id
            ]
        );
    } else {
        $db->query(
            'UPDATE users SET
                email = :email,
                first_name = :first_name,
                middle_name = :middle_name,
                last_name = :last_name,
                suffix = :suffix,
                role = :role,
                program_id = :program_id,
                updated_at = :updated_at
             WHERE user_id = :user_id',
            [
                'email' => $email,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'last_name' => $last_name,
                'suffix' => $suffix,
                'role' => $role,
                'program_id' => $program_id,
                'updated_at' => $datetime,
                'user_id' => $user_id
            ]
        );
    }

    if ($passwordChanged) {
        $_SESSION['success'] = 'User updated successfully, password changed.';
    } else {
        $_SESSION['success'] = 'User updated successfully.';
    }
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to update user: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/users'));
die();

