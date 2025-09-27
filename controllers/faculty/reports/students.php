<?php
// controllers/admin/users/check-email.php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

header('Content-Type: application/json');
 
    try {
  
        $subject = $_GET['subject'];

        $students = $db->query(
                'SELECT st.*, u.first_name, u.middle_name, u.last_name, u.suffix
                        FROM students st
                        LEFT JOIN users u ON st.user_id = u.user_id
                        LEFT JOIN program_sections ps ON st.section_id = ps.section_id
                        LEFT JOIN subjects sb ON ps.section_id = sb.section_id
                        WHERE sb.subject_id = :subject',
                [':subject' => $subject]
        )->fetchAll();


     

        echo json_encode(value: [ 'students' => $students]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }



exit;
