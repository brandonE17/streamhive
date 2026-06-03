<?php

class VideoModel {

    private PDO $conn;

    public function __construct(PDO $db) {
        $this->conn = $db;
    } 

    public function addComment(int $videoId, int $userId, string $commentText): void {
        $sql = "INSERT INTO comments (video_id, user_id, comment_text)
                VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$videoId, $userId, $commentText]);
    }

    public function addLike(int $videoId, int $userId): void {
        $sql = "INSERT INTO likes (video_id, user_id)
                VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$videoId, $userId]);
    }

    public function saveVideo(string $title, string $description, string $thumbnailPath, string $videoPath, int $userId): int {
        $sql = "INSERT INTO videos (title, description,user_id)
                VALUES (?, ?, ?,)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$title, $description, $userId]);

        return (int)$this->conn->lastInsertId();
    }
}  