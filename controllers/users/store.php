<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);


$first_name = $_POST['first-name'];
$middle_name = $_POST['middle-name'];
$last_name = $_POST['last-name'];
$suffix = $_POST['suffix'];
$password = $_POST['password'];
$email = $_POST['email'];
$program_id = $_POST['program'];
$role = $_POST['role'];
$about = $_POST['about'];
$datetime = date('Y-m-d H:i:s');

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {


    $db->query(
        'INSERT INTO users (email, password, first_name, middle_name, last_name, suffix, role, program_id, created_at)
         VALUES (:email, :password, :first_name, :middle_name, :last_name, :suffix, :role, :program_id, :created_at)',
        [
            'email' => $email,
            'password' => $hashedPassword,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'suffix' => $suffix,
            'role' => $role,
            'program_id' => $program_id,
            'created_at' => $datetime
        ]
    );

    $_SESSION['success'] = 'User created successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to create user: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/users'));
die();
