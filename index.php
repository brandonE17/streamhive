<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: core/login.php');
    exit;
}

require_once __DIR__ . '/app/models/VideoModel.php';
$db = include __DIR__ . '/core/Database.php';
$videoModel = new VideoModel($db);
$videos = $videoModel->getAllVideos();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamHive</title>
    <link rel="stylesheet" href="./style.css"> 
</head>
<body>
 
<div class="layout">
 
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">STREAMHIVE</div>

        <nav>
            <a href="index.php">Home</a>
            <a href="#">Trending</a>
            <a href="#">Subscriptions</a>
            <a href="#">Library</a>
            <a href="#">History</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">

        <!-- TOP BAR -->
        <div class="topbar">
            <input type="text" class="search" placeholder="Search videos...">
            <div class="profile">
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </div>
        </div>

        <h2>Recommended</h2>

        <!-- VIDEO GRID -->
        <div class="video-grid">
            <?php if (empty($videos)): ?>
                <div class="video-card">
                    <p class="title">Geen video’s gevonden.</p>
                </div>
            <?php else: ?>
                <?php foreach ($videos as $video): ?>
                    <div class="video-card">
                        <video class="thumb" controls muted preload="metadata">
                            <source src="<?= htmlspecialchars($video['video_path'], ENT_QUOTES, 'UTF-8') ?>" type="video/mp4">
                            Je browser ondersteunt HTML5 video niet.
                        </video>
                        <p class="title"><?= htmlspecialchars($video['title'], ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="meta"><?= nl2br(htmlspecialchars($video['description'], ENT_QUOTES, 'UTF-8')) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </main>

</div>

</body>
</html>