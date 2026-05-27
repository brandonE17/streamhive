<?php
session_start();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>StreamHive</title>
</head>
<body> 

<header class="navbar">
    <div class="nav-left">
        <h2 class="logo">STREAM<span>HIVE</span></h2>
    </div>
 
    <div class="nav-center">
        <input type="text" class="search" placeholder="Search videos...">
    </div>

    <div class="nav-right">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="nav-icon">Log out</a>
            <img src="img/profile.jpg" class="profile">
        <?php else: ?>
            <a href="core/login.php" class="nav-icon">Log in</a>
        <?php endif; ?>
    </div>
</header>  