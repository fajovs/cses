<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$subject_name = $_POST['subject_name'];
$program_id = $_POST['program_id'];
$subject_about = $_POST['subject_about'];
$section_id  = $_POST['section_id'];
$faculty_id  = $_POST['faculty_id'];
$subject_id  = $_POST['subject_id'];



$datetime = date('Y-m-d H:i:s');

if (!$program_id) {
    $_SESSION['error'] = 'Program ID is missing.';
    header('Location: ' . base_url('/admin/programs'));
    exit;
}

try {

    $db->query(
        'UPDATE subjects 
     SET program_id = :program_id,
         subject_name = :subject_name,
         subject_about = :subject_about,
         section_id = :section_id,
         faculty_id = :faculty_id,
         updated_at = :up
     WHERE subject_id = :subject_id',
        [
            ':program_id' => $program_id,
            ':subject_name' => $subject_name,
            ':subject_about' => $subject_about,
            ':section_id' => $section_id,
            ':faculty_id' => $faculty_id,
            ':up' => $datetime,
            ':subject_id' => $subject_id
        ]


    );



    $_SESSION['success'] = 'Subject updated successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to update Subject: ' . $e->getMessage();
}

// Redirect
header('Location: ' . base_url('/admin/program/' . $program_id . "/subjects"));
exit;
