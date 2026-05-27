<?php
session_start();

// Als je niet bent ingelogd, ga naar login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../core/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StreamHive</title>
    <link rel="stylesheet" href="../style.css">
</head>
 
<body> 
    <!-- NAVBAR -->
    <header class="navbar">
        <div class="logo">
            <span class="logo-stream">STREAM</span><span class="logo-hive">HIVE</span>
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Search videos...">
        </div>

        <div class="right-icons">
            <a href="#">
                <img src="../assets/icons/upload.svg" alt="upload" class="icon">
            </a>
            <a href="#">
                <img src="../assets/icons/bell.svg" alt="notifications" class="icon">
            </a>
            <a href="#">
                <img src="../assets/icons/user.svg" alt="profile" class="icon">
            </a>
        </div>
    </header>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <a href="#" class="side-item active">Home</a>
        <a href="#" class="side-item">Trending</a>
        <a href="#" class="side-item">Subscriptions</a>
        <a href="#" class="side-item">Library</a>
        <a href="#" class="side-item">History</a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="content">
        <h2>Recommended</h2>

        <div class="video-grid">
            <!-- Video card 1 -->
            <div class="video-card">
                <img src="../assets/thumbnails/video1.jpg" class="thumb">
                <h3>Exploring the Mountains</h3>
                <p>Adventure World • 10K views • 2 days ago</p>
            </div>

            <!-- voorbeeld repetitie -->
            <div class="video-card">
                <img src="../assets/thumbnails/video2.jpg" class="thumb">
                <h3>How to Code in PHP</h3>
                <p>CodeWithDev • 5K views • 1 week ago</p>
            </div>
        </div>
    </main>

</body>
</html> 