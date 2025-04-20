<?php
require_once __DIR__ . '/../config/database.php';

class Transaction
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAllByUser($userId)
    {
        $query = "SELECT * FROM transactions WHERE user_id = :user_id ORDER BY transaction_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id, $userId)
    {
        $sql = "DELETE FROM transactions WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id, 'user_id' => $userId]);
    }

    public function add($data)
    {
        $sql = "INSERT INTO transactions (
                  user_id, category_name, type, amount, payment_method, comment, transaction_date
                ) VALUES (
                  :user_id, :category_name, :type, :amount, :payment_method, :comment, :transaction_date
                )";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'user_id' => $data['user_id'],
            'category_name' => $data['category_name'],
            'type' => $data['type'], // will be 'expense'
            'amount' => $data['amount'],
            'payment_method' => $data['payment_method'],
            'comment' => $data['comment'],
            'transaction_date' => $data['transaction_date']
        ]);
    }

    public function getExpensesByCategory($userId)
    {
        $sql = "SELECT category_name, SUM(amount) as total
                FROM transactions
                WHERE user_id = :user_id AND type = 'expense'
                GROUP BY category_name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExpensesByMonth($userId)
    {
        $sql = "SELECT DATE_FORMAT(transaction_date, '%Y-%m') as month, SUM(amount) as total
                FROM transactions
                WHERE user_id = :user_id AND type = 'expense'
                GROUP BY month
                ORDER BY month";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIncomeAndExpensesByMonth($userId)
    {
        $sql = "
          SELECT 
            DATE_FORMAT(transaction_date, '%Y-%m') AS month,
            SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) AS total_expense,
            SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) AS total_income
          FROM transactions
          WHERE user_id = :user_id
          GROUP BY month
          ORDER BY month;
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMonthlyExpensesTotal($userId, $month)
    {
        $sql = "SELECT SUM(amount) as total FROM transactions 
                WHERE user_id = :user_id AND type = 'expense'
                AND DATE_FORMAT(transaction_date, '%Y-%m') = :month";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId, 'month' => $month]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getMonthlyIncomesTotal($userId, $month)
    {
        $sql = "SELECT SUM(amount) as total FROM transactions 
                WHERE user_id = :user_id AND type = 'income'
                AND DATE_FORMAT(transaction_date, '%Y-%m') = :month";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId, 'month' => $month]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getDailyIncomeExpenseThisMonth($userId)
    {
        $sql = "
          SELECT 
            DAY(transaction_date) as day,
            SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) AS total_income,
            SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) AS total_expense
          FROM transactions
          WHERE user_id = :user_id
            AND MONTH(transaction_date) = MONTH(CURRENT_DATE())
            AND YEAR(transaction_date) = YEAR(CURRENT_DATE())
          GROUP BY day
          ORDER BY day
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
