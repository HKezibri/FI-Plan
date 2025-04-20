<?php
// Start session
session_start();

// Manual includes (can be replaced later with autoloader)
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/TransactionController.php';


// Routing based on 'action' in query string
$action = $_GET['action'] ?? 'login';

try {
    switch ($action) {
        case 'register':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new UserController();
                $controller->register($_POST);
            } else {
                include '../frontend/html/register.php';
            }
            break;

        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new UserController();
                $controller->login($_POST);
            } else {
                include '../frontend/html/login.php';
            }
            break;

        case 'logout':
            session_start();
            session_unset();
            session_destroy();
            header('Location: ../frontend/html/login.php');
            exit;

        case 'welcome':
            include '../frontend/html/welcome.html';
            break;

        case 'dashboard':
            include '../frontend/html/dashboard.html';
            break;

        case 'transactions':
            include '../frontend/html/transactions.php';
            $controller = new TransactionController();
            $controller->index(1);
            break;

        case 'get_transactions':
            if (isset($_SESSION['user'])) {
                $controller = new TransactionController();
                $controller->index($_SESSION['user']['id']);
            } else {
                echo json_encode(['error' => 'Not logged in']);
            }
            break;

        case 'delete_transaction':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
                $controller = new TransactionController();
                $controller->delete($_POST, $_SESSION['user']['id']);
            }
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
            echo json_encode(['error' => 'No valid action provided']);
            break;
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
