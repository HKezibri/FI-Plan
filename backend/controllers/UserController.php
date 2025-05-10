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
                'email' => $user['email'],
                'role' => $user['role']
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
            header('Location: ../frontend/html/login.php');
        } else {
            $_SESSION['register_error'] = "Une erreur est survenue lors de l'inscription.";
            header('Location: ../frontend/html/register.php');
        }

        exit;
    }


    public function update($post)
    {
        session_start();
        require_once __DIR__ . '/../models/User.php';

        $userModel = new User();
        $userId = $_SESSION['user']['id'];

        // Update info
        if (isset($post['update_info'])) {
            $full_name = trim($post['full_name']);
            //$email = trim($post['email']);

            if ($userModel->updateInfo($userId, $full_name, $email)) {
                $_SESSION['user']['full_name'] = $full_name;
                //$_SESSION['user']['email'] = $email;
                $_SESSION['settings_message'] = "Informations mises à jour.";
            } else {
                $_SESSION['settings_message'] = "Erreur lors de la mise à jour.";
            }
        }

        // Update password
        if (isset($post['update_password'])) {
            $old = $post['old_password'];
            $new = $post['new_password'];
            $confirm = $post['confirm_password'];

            $user = $userModel->getById($userId);

            if (!$user || $user['password'] !== $old) {
                $_SESSION['settings_message'] = "Ancien mot de passe incorrect.";
            } elseif ($new !== $confirm) {
                $_SESSION['settings_message'] = "Les mots de passe ne correspondent pas.";
            } else {
                $userModel->updatePassword($userId, $new);
                $_SESSION['settings_message'] = "Mot de passe mis à jour.";
            }
        }

        header("Location: ../frontend/html/settings.php");
        exit;
    }


}
