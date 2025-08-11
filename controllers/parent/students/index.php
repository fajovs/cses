<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);




$user = $db->query(
    "SELECT * FROM parents WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();



$students = $db->query(
    "SELECT
        l.*,
        CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS student_name,
        ps.section_name,
        p.*
    FROM links l
    LEFT JOIN students st ON l.student_id = st.student_id
    LEFT JOIN program_sections ps ON st.section_id = ps.section_id
    LEFT JOIN users u ON st.user_id = u.user_id
    LEFT JOIN programs p ON st.program_id = p.program_id
    WHERE l.parent_id = :parent_id"
    ,
    [':parent_id' => $user['parent_id']]
)->fetchAll();



view('/parent/students/index.view.php', [
    'heading' => 'Students',
    'students' => $students,
    
]);
