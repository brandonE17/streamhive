<?php
class UserModel {
    private PDO $conn;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function registerUser(string $email, string $password): int {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email, $hashedPassword]);

        return (int)$this->conn->lastInsertId();
    }

    public function getUserByEmail(string $email): ?array {
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function loginValidate(string $email, string $password): ?array {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // login gelukt
        }

        return null; // login mislukt
    }
} 