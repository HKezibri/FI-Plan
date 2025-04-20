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

}
