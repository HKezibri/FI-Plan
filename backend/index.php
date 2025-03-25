<?php
// Start session
session_start();

// Manual includes (can be replaced later with autoloader)
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/controllers/authController.php';
require_once __DIR__ . '/models/Authentification.php';
require_once __DIR__ . '/exceptions/AuthentificationException.php';

use backend\controllers\AuthentificationController;

// Instantiate controller
$controller = new AuthentificationController();

// Routing based on 'action' in query string
$action = $_GET['action'] ?? 'login';

try {
    switch ($action) {
        case 'register':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->register($_POST);
            } else {
                include '../frontend/html/register.html';
            }
            break;

        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->login($_POST);
            } else {
                include '../frontend/html/login.html';
            }
            break;

        case 'logout':
            $controller->logout();
            break;

        case 'welcome':
            include '../frontend/html/welcome.html';
            break;

        case 'dashboard':
            include '../frontend/html/dashboard.html';
            break;

        case 'transactions':
            include '../frontend/html/transactions.php';
            break;

        case 'add_expense':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Handle form submission
                // e.g. $controller->addExpense($_POST);
            } else {
                include '../frontend/html/add_expense.php';
            }
            break;

        case 'add_income':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // $controller->addIncome($_POST);
            } else {
                include '../frontend/html/add_income.php';
            }
            break;


        default:
            echo "404 - Page not found";
            break;
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
