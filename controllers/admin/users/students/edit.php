<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$user_id = $params['id'];



$user = $db->query(
    "SELECT u.*, s.* FROM users u LEFT JOIN students s ON u.user_id = s.user_id WHERE u.user_id = :user_id",
    [ ':user_id' => $user_id]
)->fetch();

$programs = $db->query(
    "SELECT * FROM programs"
)->fetchAll();


if(!$user){
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

view('/admin/users/students/edit.view.php', [
    'heading' => 'Create Faculty',
    'user' => $user,
    'programs' => $programs
]);
