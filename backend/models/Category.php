<?php
require_once __DIR__ . '/../config/database.php';

class Category
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getExpenseCategories()
    {
        $sql = "SELECT id, name FROM categories WHERE type = 'expense'";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIncomeCategories()
    {
        $sql = "SELECT id, name FROM categories WHERE type = 'income'";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
