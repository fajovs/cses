<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$user_id = $params['id'];



$user = $db->query(
    "SELECT u.*, p.* FROM users u LEFT JOIN parents p ON u.user_id = p.user_id WHERE u.user_id = :user_id",
    [ ':user_id' => $user_id]
)->fetch();




if(!$user){
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

view('/admin/users/parents/edit.view.php', [
    'heading' => 'Create Faculty',
    'user' => $user,
  
]);
