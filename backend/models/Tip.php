<?php
require_once __DIR__ . '/../config/database.php';

class Tip
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getRandomTip()
    {
        $sql = "SELECT message FROM tips ORDER BY RAND() LIMIT 1";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
