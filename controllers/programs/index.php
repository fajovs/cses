<?php

use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);

$programs = $db->query(
    'SELECT 
        p.*, 
        COUNT(DISTINCT f.faculty_id) AS faculty_count,
        COUNT(DISTINCT s.student_id) AS student_count,
        COUNT(DISTINCT sub.subject_id) AS subject_count
    FROM program p
    LEFT JOIN faculty f ON p.program_id = f.program_id
    LEFT JOIN student s ON p.program_id = s.program_id
    LEFT JOIN subject sub ON p.program_id = sub.program_id
    GROUP BY p.program_id'
)->fetchAll();





view('/programs/programs.view.php', ['heading' => 'Programs', 'programs' => $programs]);
