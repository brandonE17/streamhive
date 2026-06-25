<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    exit;
}

require_once __DIR__ . '/app/models/LikeModel.php';

$db = include __DIR__ . '/core/Database.php';

$likeModel = new LikeModel($db);

$videoId = (int)($_POST['video_id'] ?? 0);

if ($videoId > 0) {

    $likeModel->addLike(
        $videoId,
        (int)$_SESSION['user_id']
    );
}

header("Location: watch.php?id=$videoId");
exit;