<?php
// controllers/admin/users/check-email.php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

header('Content-Type: application/json');
 
    try {
  
        $student = $_GET['student'];

        $subjects = $db->query(
                'SELECT sb.*
                        FROM subjects sb
                        LEFT JOIN program_sections ps ON sb.section_id = ps.section_id
                        LEFT JOIN students st ON ps.section_id = st.section_id
                        WHERE st.student_id = :student_id',
                [':student_id' => $student]
        )->fetchAll();


     

        echo json_encode(value: [ 'subjects' => $subjects]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }



exit;
