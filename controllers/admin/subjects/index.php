<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$program_id = $params['id'];

$program = $db->query(
    "SELECT * FROM programs WHERE program_id = :program_id",
    [':program_id' => $program_id]
)->fetch();

$subjects = $db->query(
    "SELECT
        s.*,
        CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name, ' ', COALESCE(u.suffix, '')) AS faculty_name,
        COUNT(DISTINCT st.student_id) AS student_count,
        ps.section_name
    FROM subjects s
    LEFT JOIN program_sections ps ON s.section_id = ps.section_id
    LEFT JOIN faculties f ON s.faculty_id = f.faculty_id
    LEFT JOIN students st ON ps.section_id = st.section_id
    LEFT JOIN users u ON f.user_id = u.user_id
    WHERE s.program_id = :program_id
    GROUP BY s.subject_id",
    [':program_id' => $program_id]
)->fetchAll();

if (!$program) {
    http_response_code(404);
    require base_path('views/404.view.php');
    exit;
}

view('/admin/subjects/index.view.php', [
    'heading' => 'Subjects',
    'subjects' => $subjects,
    'program' => $program,
]);
