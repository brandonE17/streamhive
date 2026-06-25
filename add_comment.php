<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: core/login.php');
    exit;
}

require_once __DIR__ . '/app/models/CommentModel.php';

$db = include __DIR__ . '/core/Database.php';

$commentModel = new CommentModel($db);

$videoId = (int)($_POST['video_id'] ?? 0);
$content = trim($_POST['comment'] ?? '');

if ($videoId > 0 && $content !== '') {

    $commentModel->addComment(
        $videoId,
        (int)$_SESSION['user_id'],
        $content
    );
}

header("Location: watch.php?id=$videoId");
exit;