<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);



$program_id = $_POST['program_id'];
$year_level  = $_POST['year_level'];

$section_name  = $_POST['section_name'];


try {

     $db->query(
        'INSERT INTO program_sections (program_id, section_name, year_level)
         VALUES (:program_id, :section_name, :year_level)',
        [
            ':program_id' => $program_id,
            ':section_name' => $section_name,
            ':year_level' => $year_level
        ]
    );

  
 

    $_SESSION['success'] = 'Section created successfully!';

} catch (Exception $e) {
    
    $_SESSION['error'] = 'Failed to create Section: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/program/' . $program_id)."/sections");
exit;
