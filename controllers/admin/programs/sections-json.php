<?php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

// Get program_id from query string
$programId = $_GET['program_id'] ?? null;

if ($programId) {
    try {
        $sections = $db->query(
            "SELECT section_id, section_name FROM program_sections WHERE program_id = :program_id",
            [':program_id' => $programId]
        )->fetchAll();

        header('Content-Type: application/json');
        echo json_encode($sections);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing program_id']);
}
exit;
