<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);



$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];




if ($role === 'faculty') {

   
    $users = $db->query(
        "SELECT u.*, f.*, p.* FROM users u 
        LEFT JOIN faculties f ON u.user_id = f.user_id 
        LEFT JOIN programs p ON f.program_id = p.program_id 
        WHERE u.user_id = :user_id",
        [':user_id' => $user_id]
    )->fetch();
}

if ($role === 'student') {
    $users = $db->query(
        "SELECT u.*, s.*, p.*, ps.* FROM users u 
        LEFT JOIN students s ON u.user_id = s.user_id 
        LEFT JOIN programs p ON s.program_id = p.program_id 
        LEFT JOIN program_sections ps ON s.section_id = ps.section_id 
        WHERE u.user_id = :user_id",
        [':user_id' => $user_id]
    )->fetch();
}

if ($role === 'parent') {
    $users = $db->query(
        "SELECT u.*, p.* FROM users u LEFT JOIN parents p ON u.user_id = p.user_id WHERE u.user_id = :user_id",
        [':user_id' => $user_id]
    )->fetch();
} 

if($role === 'admin') {
    $users = $db->query(
        "SELECT * FROM users WHERE user_id = :user_id",
        [':user_id' => $user_id]
    )->fetch();
}



$programs = $db->query(
    "SELECT * FROM programs"
)->fetchAll();


if (!$users) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}



view('/profile.view.php', [
    'heading' => 'My Profile',
    'users' => $users

]);
