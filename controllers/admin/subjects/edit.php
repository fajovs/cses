<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$program_id = $params['id'];
$subject_id = $params['sid'];

$subject =  $db->query("SELECT * FROM subjects WHERE subject_id =" .$subject_id)->fetch();

$faculties = $db->query(
    "SELECT  
        u.*, 
        CONCAT(f.faculty_number, ' - ', u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS faculty_name,
        f.*
    FROM users u
    LEFT JOIN faculties f ON u.user_id = f.user_id"
)->fetchAll();



$programs = $db->query(
    "SELECT * FROM programs"
)->fetchAll();

if(!$program_id){
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

if(!$subject_id){
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}



view('/admin/subjects/edit.view.php', [
    'heading' => $subject['subject_name'],
    'subject' => $subject,
    'programs' => $programs,
    'faculties' => $faculties,
]);
