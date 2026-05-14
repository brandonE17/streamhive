<?php
class UserModel {

//  zorgt voor de Databaseverbinding
    private PDO $conn;
//  constructor die de databaseverbinding accepteert en opslaat in de klasse
    public function __construct(PDO $db) {
        $this->conn = $db;
    }
//  functie om een video toe te voegen aan de database
    public function create_Video(int $userId, string $title, string $description): void {
        $sql = "INSERT INTO videos (user_id, title, description)
                VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql); //
        $stmt->execute([$userId, $title, $description]); //  dit voert de SQL-query uit 
    }
}
?>  