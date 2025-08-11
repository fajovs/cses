<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);

$section_id = $_POST['section_id'] ?? null;
$program_id = $_POST['program_id'] ?? null;




if (!$section_id) {
    $_SESSION['error'] = 'Section ID is missing.';
    header('Location: ' . base_url('/admin/program/' . $program_id));
    exit;
}

try {
    $stmt = $db->query(
        'DELETE FROM program_sections WHERE section_id = :section_id',
        [':section_id' => $section_id]
    );

    

  
        $_SESSION['success'] = 'Section deleted successfully!';
  
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to delete Section: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/program/' . $program_id."/sections"));
exit;
