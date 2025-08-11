<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);



$students = $db->query(
    "SELECT 
        u.*,
        s.*,
        CONCAT(s.student_number, ' - ', u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS full_name
    FROM users u
    LEFT JOIN students s ON u.user_id = s.user_id
    WHERE u.role = 'student'"
)->fetchAll();


$parents = $db->query(
    "SELECT  
        u.*, 
        p.*, 
        CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS full_name,
        p.parent_id AS pid
     FROM users u 
     LEFT JOIN parents p ON u.user_id = p.user_id 
     WHERE u.role = 'parent'"
)->fetchAll();

// Build a map of parent_id => array of linked student_ids
$links = $db->query(
    "SELECT * FROM links"
)->fetchAll();

$linked_students = [];
foreach ($links as $link) {
    $linked_students[$link['parent_id']][] = $link['student_id'];
}

view('/admin/users/parents/index.view.php', [
    'heading' => 'Users',
    'students' => $students,
    'parents' => $parents,
    'linked_students' => $linked_students,
]);