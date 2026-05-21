<?php

class UserModel 
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // User registreren
    public function registerUser($email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        $stmt->execute();

        return $this->db->lastInsertId();
    }

    // User ophalen op e-mail
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }
} 