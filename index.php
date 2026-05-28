<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: core/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamHive</title>
    <link rel="stylesheet" href="/style.css"
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
            <!-- Placeholder video cards -->
            <div class="video-card">
                <div class="thumb"></div>
                <p class="title">Video Title</p>
                <p class="meta">Channel Name – 10K views – 2 days ago</p>
            </div>

            <div class="video-card">
                <div class="thumb"></div>
                <p class="title">Video Title</p>
                <p class="meta">Channel Name – 5K views – 1 week ago</p>
            </div>

            <div class="video-card">
                <div class="thumb"></div>
                <p class="title">Video Title</p>
                <p class="meta">Channel Name – 2K views – 3 days ago</p>
            </div>

            <div class="video-card">
                <div class="thumb"></div>
                <p class="title">Video Title</p>
                <p class="meta">Channel Name – 7K views – 5 days ago</p>
            </div>
        </div>

    </main>

</div>

</body>
</html>