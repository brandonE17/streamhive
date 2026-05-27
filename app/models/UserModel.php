<?php
class UserModel {
    private PDO $conn;

    public function __construct(PDO $db) { // de connectie word meegqegeven aan de constructor
        $this->conn = $db;
    }

    public function registerUser(string $email, string $password): int { 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)"; // zoekt de users tabel in de db en zet de registratie neer
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email, $hashedPassword]);

        return (int)$this->conn->lastInsertId(); 
    }

    public function getUserByEmail(string $email): ?array { // vraagt de email en zet het neer in een string
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);  //stmt om te zorgen dat een query word uitgevoerd
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function loginValidate(string $email, string $password): ?array {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // de gebruiker word teruggegeven als de login goed gelukt is
        }

        return null; // geef niks terug als login mislukt
    }
} 