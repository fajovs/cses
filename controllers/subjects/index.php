<?php

use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);

$subjects = $db->query(
"SELECT subj.*, 
        CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS faculty_name 
        FROM subject AS subj JOIN users AS u ON subj.user_id = u.user_id"
)->fetchAll();



$programs = $db->query('SELECT * FROM program')->fetchAll();
$faculties = $db->query('SELECT * FROM users WHERE role = "faculty"')->fetchAll();




view('/subjects/subjects.view.php', ['heading' => 'Subjects', 'programs' => $programs, 'subjects' => $subjects , 'faculties' => $faculties]);
