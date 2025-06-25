<?php
use Core\Database;


$config = require base_path('config.php');
$db = new Database($config['database']);


$subjectId = $_POST['subject_id'] ?? null;
$program = $_POST['program'] ?? '';
$subject = $_POST['subject'] ?? '';
$faculty = $_POST['faculty'] ?? '';
$about = $_POST['about'] ?? '';
$datetime = date('Y-m-d H:i:s');

if (!$subjectId) {
    $_SESSION['error'] = 'Subject ID is missing.';
    header('Location: ' . base_url('/admin/subjects'));
    die();
}

try {
    $stmt = $db->query(
        'UPDATE subject 
         SET subject_name = :s_name, subject_about = :s_about, user_id = :f_id, program_id =:p_id ,updated_at = :ua 
         WHERE subject_id = :s_id',
        [
            'p_id' => $program,
            's_name' => $subject,
            's_about' => $about,
            'f_id' => $faculty,
            'ua' => $datetime,
            's_id' => $subjectId
        ]
    );

    if ($stmt->rowCount() > 0) {
        $_SESSION['success'] = 'Subject updated successfully!';
    } else {
        $_SESSION['error'] = 'Update ran but no changes were made. Check if the data is different or the ID exists.';
    }
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to update Subject: ' . $e->getMessage();
}

header('Location: ' . base_url('/admin/subjects'));
die();
