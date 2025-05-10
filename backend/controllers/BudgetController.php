<?php
require_once __DIR__ . '/../models/Budget.php';
require_once __DIR__ . '/../models/Transaction.php';

class BudgetController
{

    public function setUpdateBudget($post, $userId)
    {
        $budget = new Budget();
        $success = $budget->setOrUpdate($_SESSION['user']['id'], $_POST['amount']);

        session_start();
        if ($success) {
            $_SESSION['message'] = 'Transaction supprimée avec succès.';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression.';
        }

        header('Location: ../frontend/html/dashboard.php');
        exit;
    }

    public function getRemainingBudget($userId)
    {
        $month = date('Y-m');
        $budget = new Budget();
        $transactionModel = new Transaction();

        $spent = $transactionModel->getMonthlyExpensesTotal($userId, $month);
        $income = $transactionModel->getMonthlyIncomesTotal($userId, $month);

        $budget = $budget->getForCurrentMonth($userId);
        $budgetAmount = $budget ? $budget['amount'] : 0;

        return $budgetAmount + $income - $spent;
    }

}