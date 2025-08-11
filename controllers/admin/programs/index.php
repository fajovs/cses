<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);



// Get programs with counts
$programs = $db->query(
    'SELECT 
        p.program_id, 
        p.program_name, 
        COUNT(DISTINCT f.faculty_id) AS faculty_count,
        COUNT(DISTINCT s.student_id) AS student_count,
        COUNT(DISTINCT sub.subject_id) AS subject_count
    FROM programs p
    LEFT JOIN faculties f ON p.program_id = f.program_id
    LEFT JOIN students s ON p.program_id = s.program_id
    LEFT JOIN subjects sub ON p.program_id = sub.program_id
    GROUP BY p.program_id'
)->fetchAll();

view('/admin/programs/index.view.php', [
    'heading' => 'Programs',
    'programs' => $programs,
]);
