<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$parent = $db->query(
    "SELECT * FROM parents WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

$parent_id = $parent['parent_id']; 




$students = $db->query( "
             SELECT st.*, CONCAT(st.student_number, ' - ', u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS student_name
             FROM students st
             LEFT JOIN users u ON st.user_id = u.user_id
             LEFT JOIN links l ON st.student_id = l.student_id
             WHERE l.parent_id = :parent_id",
[
        ':parent_id' => $parent_id,
    ]
)->fetchAll();



view('/parent/reports/index.view.php', [
    'heading' => 'Reports',
    'students' => $students,
]);

