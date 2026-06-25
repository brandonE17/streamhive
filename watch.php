<?php

session_start();



require_once __DIR__ . '/app/models/VideoModel.php';

$db = include __DIR__ . '/core/Database.php';

$videoModel = new VideoModel($db);

require_once __DIR__ . '/app/models/CommentModel.php';

$commentModel = new CommentModel($db);


$id = (int)($_GET['id'] ?? 0);

require_once __DIR__ . '/app/models/LikeModel.php';

$likeModel = new LikeModel($db);

$likeCount = $likeModel->countLikes($id);

$video = $videoModel->getVideoById($id);
$comments = $commentModel->getCommentsByVideoId($id);

if (!$video) {
    die('Video niet gevonden');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($video['title']) ?></title>
</head>
<body>

<h1><?= htmlspecialchars($video['title']) ?></h1>

<video controls width="800">
    <source src="<?= htmlspecialchars($video['video_path']) ?>" type="video/mp4">
</video>

<p><?= htmlspecialchars($video['description']) ?></p>

<form action="like_video.php" method="POST">

    <input
        type="hidden"
        name="video_id"
        value="<?= $video['id'] ?>"
    >

    <button type="submit">
        Like
    </button>

</form>
 
<p>
    Likes: <?= $likeCount ?>
</p> 
 
<h2>Reacties</h2>

<form action="add_comment.php" method="POST">
 
    <input
        type="hidden"
        name="video_id"
        value="<?= $video['id'] ?>"
    >

    <textarea
        name="comment"
        rows="4"
        required
    ></textarea>

    <button type="submit">
        Plaats reactie
    </button>

</form>
</body>
</html>

<hr>

<h3>Alle reacties</h3>

<?php if (empty($comments)): ?>

    <p>Er zijn nog geen reacties.</p>

<?php else: ?>

    <?php foreach ($comments as $comment): ?>

        <div class="comment">

            <strong>
                <?= htmlspecialchars($comment['email']) ?> 
            </strong>

            <br>

            <small>
                <?= htmlspecialchars($comment['created_at']) ?>
            </small>

            <p>
                <?= nl2br(htmlspecialchars($comment['content'])) ?>
            </p>

        </div>

        <hr>

    <?php endforeach; ?>
 
<?php endif; ?> 