<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Transaction.php';


class Budget
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getForCurrentMonth($userId)
    {
        $month = date('Y-m');
        $sql = "SELECT amount FROM budgets WHERE user_id = :user_id AND month = :month";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId, 'month' => $month]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setOrUpdate($userId, $amount)
    {
        $month = date('Y-m');
        $sql = "INSERT INTO budgets (user_id, month, amount)
            VALUES (:user_id, :month, :amount)
            ON DUPLICATE KEY UPDATE amount = :amount";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['user_id' => $userId, 'month' => $month, 'amount' => $amount]);
    }


    public function getRemainingBudget($userId)
    {
        $month = date('Y-m');
        $transactionModel = new Transaction();

        $spent = $transactionModel->getMonthlyExpensesTotal($userId, $month);
        $income = $transactionModel->getMonthlyIncomesTotal($userId, $month);

        $budget = $this->getForCurrentMonth($userId);
        $budgetAmount = $budget ? $budget['amount'] : 0;

        return $budgetAmount + $income - $spent;
    }

}
