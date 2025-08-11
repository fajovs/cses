<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$faculties = $db->query(
    "SELECT  
        u.*, 
        f.*, 
        p.program_name,
        CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS full_name
     FROM users u 
     LEFT JOIN faculties f ON u.user_id = f.user_id 
     LEFT JOIN  programs p ON f.program_id = p.program_id 
     WHERE u.role = 'faculty'"
)->fetchAll();



view('/admin/users/faculties/index.view.php', [
    'heading' => 'Users',
    'faculties' => $faculties,
    
]);

