<?php
// controllers/admin/users/check-email.php
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

header('Content-Type: application/json');

try {
    // Sanitize & trim email
    $email = isset($_GET['email']) ? trim($_GET['email']) : '';

    $exists = false;

    if ($email !== '') {
        $user = $db->query(
            'SELECT 1 FROM users WHERE email = :email LIMIT 1',
            [':email' => $email]
        )->fetch();

        if ($user) {
            $exists = true;
        }
    }

    echo json_encode(['exists' => $exists]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error']);
}
exit;
