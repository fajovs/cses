<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

// faculty info
$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

$faculty_id = $user['faculty_id'];


$subjects = $db->query( "SELECT sb.subject_id, CONCAT(sb.subject_name, ' - ', ps.section_name  ) subject_name
                                FROM subjects sb
                                LEFT JOIN program_sections ps ON sb.section_id = ps.section_id
                                WHERE sb.faculty_id = :faculty_id",
                            [
                                    ':faculty_id' => $faculty_id,
                                ]
)->fetchAll();


view('/faculty/reports/index.view.php', [
    'heading' => 'Reports',
    'subjects' => $subjects,
  
]);

