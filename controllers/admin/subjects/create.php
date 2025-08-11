<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$program_id = $params['id'];

$program = $db->query(
    "SELECT * FROM programs WHERE program_id = :program_id",
    [':program_id' => $program_id]
)->fetch();

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


if (!$program) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}


view('/admin/subjects/create.view.php', [
    'heading' => 'Create Subject',
    'program' => $program,
    'programs' => $programs,
    'faculties' => $faculties,
]);
