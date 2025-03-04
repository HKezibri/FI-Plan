<?php

namespace backend\controllers;

use backend\app\Authentification;
use backend\exception\AuthentificationException;

class AuthentificationController {
    private $auth;

    public function __construct() {
        session_start();
        $this->auth = new Authentification();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Fetch user from database
            $user = $this->getUserByEmail($email);

            if (!$user) {
                echo "<script>alert('User not found'); window.location.href='../login.html';</script>";
                exit();
            }

            try {
                $this->auth->login($user['email'], $user['password'], $password, $user['access_level']);
                header("Location: ../dashboard.html"); // Redirect to dashboard
                exit();
            } catch (AuthentificationException $e) {
                echo "<script>alert('" . $e->getMessage() . "'); window.location.href='../login.html';</script>";
            }
        }
    }

    public function logout() {
        $this->auth->logout();
        header("Location: ../login.html");
        exit();
    }

    private function getUserByEmail($email) {
        // Dummy function, replace with a real database query
        $users = [
            "test@example.com" => [
                "email" => "test@example.com",
                "password" => password_hash("test123", PASSWORD_DEFAULT),
                "access_level" => 1
            ]
        ];

        return $users[$email] ?? null;
    }
}

// Handle login request
$controller = new AuthentificationController();
if (isset($_POST['email']) && isset($_POST['password'])) {
    $controller->login();
}

// Handle logout request
if (isset($_GET['logout'])) {
    $controller->logout();
}

?>
