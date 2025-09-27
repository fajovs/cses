<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$submissionId = $_POST['submission-id'];
$totalScore   = $_POST['total-score'];
$feedback     = $_POST['feedback'];

// Validate project and ownership
$submission = $db->query(
    "SELECT acs.*, a.* FROM project_submissions acs
     LEFT JOIN projects a ON acs.project_id = a.project_id
     WHERE submission_id = :submission_id",
    [':submission_id' => $submissionId]
)->fetch();

if (!$submission) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

$subject = $db->query(
    "SELECT s.*, ps.* 
     FROM subjects s
     LEFT JOIN program_sections ps ON s.section_id = ps.section_id
     WHERE s.subject_id = :subject_id",
    [':subject_id' => $submission['subject_id']]
)->fetch();

if (!$subject || $user['faculty_id'] != $subject['faculty_id']) {
    http_response_code(403);
    require base_path('views/403.view.php');
    exit;
}

// --- Compute Equivalent Rate ---
function computeEquivalentRate($score) {
    if ($score >= 95) return 1.0;
    if ($score >= 94) return 1.1;
    if ($score >= 93) return 1.2;
    if ($score >= 92) return 1.3;
    if ($score >= 91) return 1.4;
    if ($score >= 90) return 1.5;
    if ($score >= 89) return 1.6;
    if ($score >= 88) return 1.7;
    if ($score >= 87) return 1.8;
    if ($score >= 86) return 1.9;
    if ($score >= 85) return 2.0;
    if ($score >= 84) return 2.1;
    if ($score >= 83) return 2.2;
    if ($score >= 82) return 2.3;
    if ($score >= 81) return 2.4;
    if ($score >= 80) return 2.5;
    if ($score >= 79) return 2.6;
    if ($score >= 78) return 2.7;
    if ($score >= 77) return 2.8;
    if ($score >= 76) return 2.9;
    if ($score >= 75) return 3.0;
    if ($score >= 74) return 3.1;
    if ($score >= 73) return 3.2;
    if ($score >= 72) return 3.3;
    if ($score >= 71) return 3.4;
    if ($score >= 70) return 3.5;
    if ($score >= 69) return 3.6;
    if ($score >= 68) return 3.7;
    if ($score >= 67) return 3.8;
    if ($score >= 66) return 3.9;
    if ($score >= 65) return 4.0;
    if ($score >= 64) return 4.1;
    if ($score >= 63) return 4.2;
    if ($score >= 62) return 4.3;
    if ($score >= 61) return 4.4;
    if ($score >= 60) return 4.5;
    if ($score >= 59) return 4.6;
    if ($score >= 58) return 4.7;
    if ($score >= 57) return 4.8;
    if ($score >= 56) return 4.9;
    return 5.0; 
}

$equivalentRate = computeEquivalentRate($totalScore);

try {
    $db->query(
        "UPDATE project_submissions 
         SET feedback = :feedback, 
             total_score = :total_score, 
             equivalent_rate = :equivalent_rate,
             is_checked = 1
         WHERE submission_id = :submission_id",
        [
            ':feedback' => $feedback,
            ':total_score' => $totalScore,
            ':equivalent_rate' => $equivalentRate,
            ':submission_id' => $submissionId,
        ]
    );

    $_SESSION['success'] = 'Student project evaluated successfully!';
} catch (Exception $e) {
    $_SESSION['error'] = 'Failed to evaluate student project: ' . $e->getMessage();
}

header('Location: ' . base_url('/faculty/submissions/subject/' . $subject['subject_id'] . '/project/' . $submission['project_id']));
exit;
