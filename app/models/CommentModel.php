<?php
class CommentModel {

    private PDO $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function addComment(int $videoId, int $userId, string $content): void
    {
        $sql = "
            INSERT INTO comments
            (video_id, user_id, content, created_at)
            VALUES (?, ?, ?, NOW())
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$videoId, $userId, $content]);
    }

    public function getCommentsByVideoId(int $videoId): array
    {
        $sql = "
            SELECT
                comments.content,
                comments.created_at,
                users.email
            FROM comments
            INNER JOIN users
                ON comments.user_id = users.id
            WHERE comments.video_id = ?
            ORDER BY comments.created_at DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$videoId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 

?> 