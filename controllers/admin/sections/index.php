<?php


use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$program_id = $params['id'];

$program = $db->query(
    "SELECT * FROM programs WHERE program_id = :program_id",
    [':program_id' => $program_id]
)->fetch();


$sections = $db->query(
    "SELECT 
        ps.*, 
        COUNT(s.student_id) AS student_count
    FROM program_sections ps
    LEFT JOIN students s ON s.section_id = ps.section_id
    WHERE ps.program_id = :program_id
    GROUP BY ps.section_id",
    [':program_id' => $program_id]
)->fetchAll();

if(!$program){
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}




view('/admin/sections/index.view.php', [
    'heading' => $program['program_name'],
    'sections' => $sections,
    'program' => $program,
]);
