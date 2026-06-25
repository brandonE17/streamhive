<?php

class LikeModel {

    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function addLike(int $videoId, int $userId): void
    {
        $sql = "
            INSERT INTO likes (video_id, user_id)
            VALUES (?, ?)
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$videoId, $userId]);
    }

    public function countLikes(int $videoId): int
    {
        $sql = "
            SELECT COUNT(*)
            FROM likes
            WHERE video_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$videoId]);

        return (int)$stmt->fetchColumn();
    }
}