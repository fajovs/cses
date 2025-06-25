<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);


$subject = $_POST['subject'];
$program_id = $_POST['program'];
$user_id = $_POST['faculty'];
$about = $_POST['about'];
$datetime = date('Y-m-d H:i:s');

try {
    $db->query(
        'INSERT INTO subject ( subject_name, program_id, user_id,  subject_about, created_at) 
             VALUES (:s_name, :p_id, :u_id, :s_about, :ca)',
        [
            's_name' => $subject,
            'p_id' => $program_id,
            'u_id' => $user_id,
            's_about' => $about,
            'ca' => $datetime
        ]
    );

    $_SESSION['success'] = 'Subject created successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to create subject: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/subjects'));
die();
