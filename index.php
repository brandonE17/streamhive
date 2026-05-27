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



       
 
</body>
</html>