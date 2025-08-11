<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);


$program_id = $_POST['program_id'] ?? null;



if (!$program_id) {
    $_SESSION['error'] = 'Program ID is missing.';
    header('Location: ' . base_url('/admin/program/' . $program_id));
    exit;
}

try {
    $stmt = $db->query(
        'DELETE FROM programs WHERE program_id = :program_id',
        [':program_id' => $program_id]
    );

    

  
        $_SESSION['success'] = 'Program deleted successfully!';
  
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to delete Program: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/programs'));
exit;
