<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$programs = $db->query(
    "SELECT * FROM programs"
)->fetchAll();

view('/admin/users/faculties/create.view.php', [
    'heading' => 'Create Faculty',
    'programs' => $programs
]);
