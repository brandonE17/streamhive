<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: core/login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamHive</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <span class="red">STREAM</span>HIVE
    </div>

    <a class="nav-item active" href="index.php">
        <img src="image/home.svg" class="icon"> Home
    </a>

    <a class="nav-item" href="#">
        <img src="image/trending.svg" class="icon"> Trending
    </a>

    <a class="nav-item" href="#">
        <img src="image/subs.svg" class="icon"> Subscriptions
    </a>

    <a class="nav-item" href="#">
        <img src="image/library.svg" class="icon"> Library
    </a>

    <a class="nav-item" href="#">
        <img src="image/history.svg" class="icon"> History
    </a>

</div>

<div class="main">
    <header class="top-bar">
        <input type="text" placeholder="Search videos..." class="search-bar">

        <div class="top-right">
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </header>

    <h2 class="section-title">Recommended</h2>

    <div class="video-grid">

        <div class="video-card">
            <img src="image/video1.jpg" class="thumb">
            <h3>Exploring the Mountains</h3>
            <p>Adventure World • 10K views • 2 days ago</p>
        </div>

        <div class="video-card">
            <img src="image/video2.jpg" class="thumb">
            <h3>How to Code in PHP</h3>
            <p>CodeWithDev • 5K views • 1 week ago</p>
        </div>

        <div class="video-card">
            <img src="image/video3.jpg" class="thumb">
            <h3>Relaxing Ocean Waves</h3>
            <p>Nature Sounds • 2K views • 3 days ago</p>
        </div>

    </div>

</div>
 
</body>
</html>