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

  public function saveVideo(string $title, string $description, string $videoPath, string $filename, int $userId): int {
    $sql = "INSERT INTO videos (title, description, video_path, filename, user_id)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$title, $description, $videoPath, $filename, $userId]);

    return (int)$this->conn->lastInsertId();
}
    public function getAllVideos(): array {
        $sql = "SELECT id, title, description, video_path, user_id FROM videos ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

        
    }
public function getVideoById(int $id): ?array
{
    $sql = "SELECT * FROM videos WHERE id = ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id]);

    $video = $stmt->fetch(PDO::FETCH_ASSOC);

    return $video ?: null;
}
} 