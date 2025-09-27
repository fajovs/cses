<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);


$user = $db->query(
    "SELECT * FROM students WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

$section_id = $user['section_id']; 


$subjects = $db->query(
    "SELECT
        s.*,
        CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS faculty_name,
        COUNT(DISTINCT st.student_id) AS student_count,
        ps.section_name,

        -- Count not submitted assignments
        (
            SELECT COUNT(*) FROM assignments a
            WHERE a.subject_id = s.subject_id AND a.is_active = 1
            AND a.assignment_id NOT IN (
                SELECT assignment_id FROM assignment_submissions 
                WHERE student_id = :student_id
            )
        ) AS not_submitted_assignments,

         -- Count not submitted projects
        (
            SELECT COUNT(*) FROM projects a
            WHERE a.subject_id = s.subject_id AND a.is_active = 1
            AND a.project_id NOT IN (
                SELECT project_id FROM project_submissions 
                WHERE student_id = :student_id
            )
        ) AS not_submitted_projects,

        -- Count not attempted quizzes
        (
            SELECT COUNT(*) FROM quizzes q
            WHERE q.subject_id = s.subject_id AND q.is_active = 1
            AND q.quiz_id NOT IN (
                SELECT quiz_id FROM student_quiz_attempts 
                WHERE student_id = :student_id
            )
        ) AS not_attempted_quizzes,

        -- Count not attempted exams
        (
            SELECT COUNT(*) FROM examinations e
            WHERE e.subject_id = s.subject_id AND e.is_active = 1
            AND e.exam_id NOT IN (
                SELECT exam_id FROM student_exam_attempts 
                WHERE student_id = :student_id
            )
        ) AS not_attempted_exams

    FROM subjects s
    LEFT JOIN program_sections ps ON s.section_id = ps.section_id
    LEFT JOIN faculties f ON s.faculty_id = f.faculty_id
    LEFT JOIN students st ON ps.section_id = st.section_id
    LEFT JOIN users u ON f.user_id = u.user_id
    WHERE s.section_id = :section_id
    GROUP BY s.subject_id",
    [
        ':section_id' => $section_id,
        ':student_id' => $user['student_id']
    ]
)->fetchAll();



// if (!$program) {
//     http_response_code(404);
//     require base_path('views/404.view.php');
//     exit;
// }

view('/student/subjects/index.view.php', [
    'heading' => 'Subjects',
    'subjects' => $subjects,
   
]);
