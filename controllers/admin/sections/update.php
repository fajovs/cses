<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$section_id  = $_POST['section_id'];
$section_name  = $_POST['section_name'];
$programId = $_POST['program_id'] ?? null;


if (!$programId) {
    $_SESSION['error'] = 'Program ID is missing.';
    header('Location: ' . base_url('/admin/programs'));
    exit;
}

try {

    $db->query(
        'UPDATE program_sections 
     SET section_name = :section_name
     WHERE section_id = :section_id',
        [
            ':section_id' => $section_id,
            ':section_name' => $section_name
        ]
    );


    $_SESSION['success'] = 'Section updated successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to update Section: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/program/' . $programId . "/sections"));
exit;
