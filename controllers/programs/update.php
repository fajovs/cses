<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);


$programId = $_POST['program_id'] ?? null;
$program = $_POST['program'] ?? '';
$about = $_POST['about'] ?? '';
$datetime = date('Y-m-d H:i:s');


if (!$programId) {
    $_SESSION['error'] = 'Program ID is missing.';
    header('Location: ' . base_url('/admin/programs'));
    die();
}

try {
    $stmt = $db->query(
        'UPDATE program 
         SET program_name = :p_name, program_about = :p_about, updated_at = :ua 
         WHERE program_id = :p_id',
        [
            'p_name' => $program,
            'p_about' => $about,
            'ua' => $datetime,
            'p_id' => $programId
        ]
    );

    if ($stmt->rowCount() > 0) {
        $_SESSION['success'] = 'Program updated successfully!';
    } else {
        $_SESSION['error'] = 'Update ran but no changes were made. Check if the data is different or the ID exists.';
    }
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to update Program: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/programs'));
die();
