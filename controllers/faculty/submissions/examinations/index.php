<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$user = $db->query(
    "SELECT * FROM faculties WHERE user_id = :user_id",
    [':user_id' => $_SESSION['user_id']]
)->fetch();

$faculty_id = $user['faculty_id'];

$subjects = $db->query(
    "SELECT
        s.*,
        CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS faculty_name,
        COUNT(DISTINCT st.student_id) AS student_count,
            COUNT(DISTINCT e.exam_id) AS exam_count,
        ps.section_name
    FROM subjects s
    LEFT JOIN examinations e ON s.subject_id = e.subject_id
    LEFT JOIN program_sections ps ON s.section_id = ps.section_id
    LEFT JOIN faculties f ON s.faculty_id = f.faculty_id
    LEFT JOIN students st ON ps.section_id = st.section_id
    LEFT JOIN users u ON f.user_id = u.user_id
    WHERE s.faculty_id = :faculty_id
    GROUP BY s.subject_id",
    [':faculty_id' => $faculty_id]
)->fetchAll();


// if (!$program) {
//     http_response_code(404);
//     require base_path('views/404.view.php');
//     exit;
// }

view('/faculty/submissions/examinations/index.view.php', [
    'heading' => 'Submissions',
    'subjects' => $subjects,
    // 'program' => $program,
]);
