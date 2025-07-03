<?php


use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);

$users = $db->query('SELECT * FROM users')->fetchAll();



$emails = $db->query('SELECT email FROM users')->fetchAll(PDO::FETCH_COLUMN);
$programs = $db->query('SELECT * FROM program')->fetchAll();


view('/users/users.view.php', ['heading' => 'Users', 'emails' => $emails, 'programs' => $programs, 'users' => $users]);