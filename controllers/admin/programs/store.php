<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$program_name  = $_POST['program_name'];
$program_about   = $_POST['program_about'];



$datetime = date('Y-m-d H:i:s');


try {


    $db->query(
        'INSERT INTO programs (program_name, program_about, created_at)
         VALUES (:program_name, :program_about, :ca)',
        [
            ':program_name' => $program_name,
            ':program_about' => $program_about,
            ':ca' => $datetime
        ]
    );



    $_SESSION['success'] = 'Program created successfully!';
} catch (Exception $e) {
  
    $_SESSION['error'] = 'Failed to created Program: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/programs'));
exit;
