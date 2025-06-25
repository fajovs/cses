<?php






const BASE_PATH = __DIR__ . '/';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function($class){
    
    $class = str_replace('\\',DIRECTORY_SEPARATOR,$class);

    require base_path("{$class}.php");
});

use Core\Database;
$config = require base_path('config.php');
$db = new Database($config['database']);



$email = 'parent@example.com';
$plainPassword = '123456';
$firstName = 'Parent';
$middleName = '';
$lastName = 'User';
$suffix = '';
$role = 'parent';
$now = date('Y-m-d H:i:s');

// Use password_hash with default algorithm (bcrypt or Argon2 if available)
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

try {
    // Optional: prevent duplicate emails
    $existing = $db->query('SELECT user_id FROM users WHERE email = ?', [$email])->fetch();

    if ($existing) {
        exit("An account with email '$email' already exists.");
    }

    // Insert admin
    $db->query(
        "INSERT INTO users (email, password, first_name, middle_name, last_name, suffix, role, created_at, updated_at)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [
            $email,
            $hashedPassword,
            $firstName,
            $middleName,
            $lastName,
            $suffix,
            $role,
            $now,
            $now
        ]
    );

    echo "✅ Secure admin account created with email: $email";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
