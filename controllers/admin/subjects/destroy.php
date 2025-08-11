<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_id = $_POST['subject_id'] ?? null;
$program_id = $_POST['program_id'] ?? null;



if (!$subject_id) {
    $_SESSION['error'] = 'Subject ID is missing.';
    header('Location: ' . base_url('/admin/program/' . $program_id.'/subjects'));
    exit;
}

try {
    $stmt = $db->query(
        'DELETE FROM subjects WHERE subject_id = :subject_id',
        [':subject_id' => $subject_id]
    );

    

  
        $_SESSION['success'] = 'Subject deleted successfully!';
  
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to delete Subject: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/program/' . $program_id."/subjects"));
exit;
