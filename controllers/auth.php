<?php

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password']; // plain password from form

    try {
        $user = $db->query(
            'SELECT * FROM users WHERE email = :email',
            [
                'email' => $email,
            ]
        )->fetch();

        if (!$user) {
            $_SESSION['error'] = "Email not Registered";
            view('login.view.php', ['heading' => 'Login']);
            die();
        }

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['middle_name'] = $user['middle_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['suffix'] = $user['suffix'];
            $_SESSION['email'] = $user['email'];


            switch ($user['role']) {
                case 'admin':
                    header('Location: ' . base_url('/admin/dashboard'));
                    break;
                case 'student':
                    header('Location: ' . base_url('/student/dashboard'));
                    break;
                case 'faculty':
                    header('Location: ' . base_url('/faculty/dashboard'));
                    break;
                case 'parent':
                    header('Location: ' . base_url('/parent/dashboard'));
                    break;
            }
            exit;
        } else {
            $_SESSION['error'] = "Invalid email or password";
            view('login.view.php', ['heading' => 'Login']);
            die();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Failed: ' . $e->getMessage();
        view('login.view.php', ['heading' => 'Login']);
    }
} else {
    view('login.view.php', ['heading' => 'Login']);
}
