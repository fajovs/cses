<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$programs = $db->query(
    "SELECT * FROM programs"
)->fetchAll();

view('/admin/users/students/create.view.php', [
    'heading' => 'Create Student',
    'programs' => $programs
]);
