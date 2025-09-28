<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$user_id = $params['id'];



$user = $db->query(
    "SELECT u.*, f.* FROM users u LEFT JOIN faculties f ON u.user_id = f.user_id WHERE u.user_id = :user_id",
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

view('/admin/users/faculties/edit.view.php', [
    'heading' => 'Create Faculty',
    'users' => $user,
    'programs' => $programs
]);
