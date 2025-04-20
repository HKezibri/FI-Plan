<?php
require_once __DIR__ . '/../config/database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($full_name, $email, $role, $hashed_password)
    {
        $sql = "INSERT INTO users (full_name, email, role, password) VALUES (:full_name, :email, :role, :password)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'full_name' => $full_name,
            'email' => $email,
            'role' => $role,
            'password' => $hashed_password
        ]);
    }
}
