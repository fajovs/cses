<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$student = $db->query(
    "SELECT * FROM students WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

$section_id = $student['section_id']; 


$subjects = $db->query( "SELECT subject_id,subject_name FROM subjects WHERE section_id = :section_id",
[
        ':section_id' => $section_id,
    ]
)->fetchAll();




view('/student/reports/index.view.php', [
    'heading' => 'Reports',
    'subjects' => $subjects,
]);

