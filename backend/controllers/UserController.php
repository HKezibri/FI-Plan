<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    public function login($post)
    {
        session_start();
        $email = trim($post['email']);
        $password = $post['password'];

        $userModel = new User();
        $user = $userModel->getByEmail($email);

        if ($user && $password === $user['password']) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'full_name' => $user['full_name'],
                'email' => $user['email']
            ];
            header('Location: ../frontend/html/dashboard.php');
        } else {
            $_SESSION['login_error'] = "Email ou mot de passe incorrect.";
            header('Location: ../frontend/html/login.php');
        }
        exit;
    }

    //Register logic
    public function register($post)
    {
        session_start();
        $full_name = trim($post['full_name']);
        $email = trim($post['email']);
        $password = $post['password'];
        $confirm_password = $post['confirm_password'];

        $userModel = new User();

        // 1. Check if user exists
        if ($userModel->getByEmail($email)) {
            $_SESSION['register_error'] = "Un compte avec cet email existe déjà.";
            header('Location: ../frontend/html/register.php');
            exit;
        }

        // 2. Confirm password match
        if ($password !== $confirm_password) {
            $_SESSION['register_error'] = "Les mots de passe ne correspondent pas.";
            header('Location: ../frontend/html/register.php');
            exit;
        }

        // 3. Hash password and save
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $success = $userModel->create($full_name, $email, $password);

        if ($success) {
            // auto-login or redirect to login page
            $_SESSION['user'] = [
                'full_name' => $full_name,
                'email' => $email
            ];
            header('Location: ../frontend/html/dashboard.php');
        } else {
            $_SESSION['register_error'] = "Une erreur est survenue lors de l'inscription.";
            header('Location: ../frontend/html/register.php');
        }

        exit;
    }

}
