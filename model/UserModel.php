<?php
class UserModel {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        return $this->conn->query($sql);
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
    }

    public function createUser($email, $password) {
        $sql = "INSERT INTO users (email, password)
                VALUES (?, ?)";
    }
} 

?>