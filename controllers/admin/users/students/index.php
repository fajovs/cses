<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);




$students = $db->query(
    "SELECT  
        u.*, 
        s.*,
        p.*, 
        CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS full_name
     FROM users u 
     LEFT JOIN students s ON u.user_id = s.user_id
     LEFT JOIN  programs p ON s.program_id = p.program_id  
     WHERE u.role = 'student'"
)->fetchAll();





view('/admin/users/students/index.view.php', [
    'heading' => 'Users',

    'students' => $students,
 
    
]);

