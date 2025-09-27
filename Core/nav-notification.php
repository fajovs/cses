<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);



if ($_SESSION['role'] === 'faculty') {
    $user = $db->query(
        "SELECT * FROM faculties WHERE user_id = :user_id",
        [':user_id' => $_SESSION['user_id']]
    )->fetch();


    $assignmentNotification = $db->query(
        "SELECT 
         a.assignment_id,
         a.title AS assignment_title,
         s.subject_id,
         s.subject_name,
         COUNT(ass.submission_id) AS total_submissions,
         MAX(ass.submitted_at) AS last_submission
     FROM assignment_submissions ass
     LEFT JOIN assignments a ON ass.assignment_id = a.assignment_id
     LEFT JOIN subjects s ON a.subject_id = s.subject_id
     LEFT JOIN faculties f ON s.faculty_id = f.faculty_id
     WHERE ass.is_checked = :is_checked 
       AND f.faculty_id = :faculty_id
     GROUP BY a.assignment_id, a.title, s.subject_id, s.subject_name
     ORDER BY last_submission DESC",
        [
            ':is_checked' => 0,
            ':faculty_id' => $user['faculty_id']
        ]
    )->fetchAll();

    $projectNotification = $db->query(
        "SELECT 
         p.project_id,
         p.title AS project_title,
         s.subject_id,
         s.subject_name,
         COUNT(ps.submission_id) AS total_submissions,
         MAX(ps.submitted_at) AS last_submission
     FROM project_submissions ps
     LEFT JOIN projects p ON ps.project_id = p.project_id
     LEFT JOIN subjects s ON p.subject_id = s.subject_id
     LEFT JOIN faculties f ON s.faculty_id = f.faculty_id
     WHERE ps.is_checked = :is_checked 
       AND f.faculty_id = :faculty_id
     GROUP BY p.project_id, p.title, s.subject_id, s.subject_name
     ORDER BY last_submission DESC",
        [
            ':is_checked' => 0,
            ':faculty_id' => $user['faculty_id']
        ]
    )->fetchAll();



    // Exams
    $examNotification = $db->query(
        "SELECT 
         e.exam_id,
         e.title AS exam_title,
         s.subject_id,
         s.subject_name,
         COUNT(acs.exam_id) AS total_submissions,
         MAX(acs.submitted_at) AS last_submission
     FROM student_exam_attempts acs
     LEFT JOIN examinations e ON acs.exam_id = e.exam_id
     LEFT JOIN subjects s ON e.subject_id = s.subject_id
     LEFT JOIN faculties f ON s.faculty_id = f.faculty_id
     WHERE acs.is_checked = :is_checked 
       AND f.faculty_id = :faculty_id
     GROUP BY e.exam_id, e.title, s.subject_id, s.subject_name
     ORDER BY last_submission DESC",
        [
            ':is_checked' => 0,
            ':faculty_id' => $user['faculty_id']
        ]
    )->fetchAll();

    // Quizzes
    $quizNotification = $db->query(
        "SELECT 
         q.quiz_id,
         q.title AS quiz_title,
         s.subject_id,
         s.subject_name,
         COUNT(acs.quiz_id) AS total_submissions,
         MAX(acs.submitted_at) AS last_submission
     FROM student_quiz_attempts acs
     LEFT JOIN quizzes q ON acs.quiz_id = q.quiz_id
     LEFT JOIN subjects s ON q.subject_id = s.subject_id
     LEFT JOIN faculties f ON s.faculty_id = f.faculty_id
     WHERE acs.is_checked = :is_checked 
       AND f.faculty_id = :faculty_id
     GROUP BY q.quiz_id, q.title, s.subject_id, s.subject_name
     ORDER BY last_submission DESC",
        [
            ':is_checked' => 0,
            ':faculty_id' => $user['faculty_id']
        ]
    )->fetchAll();
}
