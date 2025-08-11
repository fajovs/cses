<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$email = trim($_POST['email']);
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$suffix = $_POST['suffix'];
$program_id = $_POST['program_id'];
$faculty_number = $_POST['faculty_number'];
$role = 'faculty';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$datetime = date('Y-m-d H:i:s');

try {
    // Start transaction
    $db->beginTransaction();

    // Insert into users
    $db->query(
        'INSERT INTO users (first_name, middle_name, last_name, suffix, email, password, role, created_at)
         VALUES (:first_name, :middle_name, :last_name, :suffix, :email, :password, :role, :ca)',
        [
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':last_name' => $last_name,
            ':suffix' => $suffix,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role' => $role,
            ':ca' => $datetime,
        ]
    );

    // Get the last inserted user ID
    $user_id = $db->lastInsertId();

    // Insert into faculties
    $db->query(
        'INSERT INTO faculties (user_id, program_id, faculty_number, created_at)
         VALUES (:user_id, :program_id, :faculty_number, :ca)',
        [
            ':user_id' => $user_id,
            ':program_id' => $program_id,
            ':faculty_number' => $faculty_number,
            ':ca' => $datetime,
        ]
    );

    // Commit transaction
    $db->commit();

    $_SESSION['success'] = 'Faculty user created successfully!';
} catch (Exception $e) {
  
   
    $db->rollBack();
    $_SESSION['error'] = 'Failed to create Faculty user: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/users/faculties'));
exit;
