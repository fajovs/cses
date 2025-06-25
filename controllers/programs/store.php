<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);


$program = $_POST['program'];
$department_id = $_POST['department'];
$about = $_POST['about'];
$datetime = date('Y-m-d H:i:s');

try {
    $db->query(
        'INSERT INTO program ( program_name,  program_about, created_at) 
             VALUES (:p_name, :p_about, :ca)',
        [
            'p_name' => $program,
            'p_about' => $about,
            'ca' => $datetime
        ]
    );

    $_SESSION['success'] = 'Program created successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to create program: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/programs'));
die();
