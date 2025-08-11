<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);



$programId = $_POST['program_id'] ?? null;
$program_name   = $_POST['program_name'];
$program_about      = $_POST['program_about'];

$datetime = date('Y-m-d H:i:s');

if (!$programId) {
    $_SESSION['error'] = 'Program ID is missing.';
    header('Location: ' . base_url('/admin/programs'));
    exit;
}

try {


    // Update program info (removed program_about)
    $db->query(
        'UPDATE programs 
         SET program_name = :p_name, program_about = :p_about, updated_at = :ua 
         WHERE program_id = :p_id',
        [
            'p_name' => $program_name,
            'p_about' => $program_about,
            'ua'     => $datetime,
            'p_id'   => $programId
        ]
    );



    $_SESSION['success'] = 'Program updated successfully!';
} catch (Exception $e) {
  
    $_SESSION['error'] = 'Failed to update Program: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/program/'. htmlspecialchars($programId)).'/sections');
exit;
