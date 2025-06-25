<?php

use Core\Validator;
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$email = trim($_POST['email']);
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$suffix = $_POST['suffix'];
$role = $_POST['role'];

$min = 8;
$errors = [];

// Validate email
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

// Validate password
if (!Validator::string($password, $min, 255)) {
    $errors['password'] = "Password must have at least $min characters.";
}

$user = $db->query('select * from users where email = :email', [
    'email' => $email
]);

if ($user) {
    $errors['emai'] = "Email is already taken.";
}

// If there are validation errors, return to the view
if (!empty($errors)) {
    return view('/users/users.view.php', [
        'heading' => 'Users',
        'errors' => $errors
    ]);

} else {

    // Save user
    $datetime = date('Y-m-d H:i:s');
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $db->query(
        "INSERT INTO users (first_name, middle_name, last_name, suffix, email, password, role, created_at) 
     VALUES (:first, :middle, :last, :suffix, :email, :password, :role, :created_at)",
        [
            'first' => 'Admin',
            'middle' => '',
            'last' => '',
            'suffix' => '',
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'admin',
            'created_at' => $datetime
        ]
    );

    // Redirect or load view after successful registration
    view('/users/users.view.php', ['heading' => 'Users']);
}
