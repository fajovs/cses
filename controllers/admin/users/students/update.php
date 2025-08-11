<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

// Collect POST data
$user_id = $_POST['user_id'];
$email = trim($_POST['email']); // note: email might be disabled, so we keep original
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$suffix = $_POST['suffix'];
$program_id = $_POST['program_id'];
$student_number = $_POST['student_number'];
$section_id = $_POST['section_id'];

$datetime = date('Y-m-d H:i:s');


try {
    // Start transaction
    $db->beginTransaction();

    // Build base query and params
    $query = '
        UPDATE users 
        SET first_name = :first_name,
            middle_name = :middle_name,
            last_name = :last_name,
            suffix = :suffix,
            updated_at = :updated_at
    ';
    $params = [
        ':first_name' => $first_name,
        ':middle_name' => $middle_name,
        ':last_name' => $last_name,
        ':suffix' => $suffix,
        ':updated_at' => $datetime,
        ':user_id' => $user_id,
    ];

    // Check if password change requested and passwords match
    if (!empty($password) && $password === $confirm_password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query .= ', password = :password';
        $params[':password'] = $hashedPassword;
    }

    // Finish query
    $query .= ' WHERE user_id = :user_id';

    // Update users table
    $db->query($query, $params);

    // Update faculties table
    $db->query(
        'UPDATE students 
         SET program_id = :program_id,
             student_number = :student_number,
             section_id = :section_id,
             updated_at = :updated_at
         WHERE user_id = :user_id',
        [
            ':program_id' => $program_id,
            ':student_number' => $student_number,
            ':section_id' => $section_id,
            ':updated_at' => $datetime,
            ':user_id' => $user_id,
        ]
    );

    // Commit transaction
    $db->commit();

    $_SESSION['success'] = 'Student user updated successfully!';
} catch (Exception $e) {
    $db->rollBack();
    $_SESSION['error'] = 'Failed to update Student user: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/users/students'));
exit;
?>
