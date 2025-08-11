<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);





$subject_name = $_POST['subject_name'];
$program_id = $_POST['program_id'];
$subject_about = $_POST['subject_about'];
$section_id  = $_POST['section_id'];
$faculty_id  = $_POST['faculty_id'];

$datetime = date('Y-m-d H:i:s');


try {

     $db->query(
        'INSERT INTO subjects (program_id, subject_name, subject_about, section_id, faculty_id, created_at)
         VALUES (:program_id, :subject_name, :subject_about, :section_id, :faculty_id, :ca)',
        [
            ':program_id' => $program_id,
            ':subject_name' => $subject_name,
            ':subject_about' => $subject_about,
            ':section_id' => $section_id,
            ':faculty_id' => $faculty_id,
            ':ca' => $datetime,
        ]
    );

  
 

    $_SESSION['success'] = 'Subject created successfully!';

} catch (Exception $e) {
    
    $_SESSION['error'] = 'Failed to create Subject: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/program/' . $program_id)."/subjects");
exit;
