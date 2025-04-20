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

}
