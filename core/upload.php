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
    <title>Upload Video – StreamHive</title>
    <link rel="stylesheet" href="style.css">
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
            <a href="upload.php" style="font-weight: bold;">Upload</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <!-- TOP BAR -->
        <div class="topbar">
            <input type="text" class="search" placeholder="Search videos...">
            <div class="profile">
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </div>
        </div>

        <h2>Upload New Video</h2>

        <div class="upload-container">

            <form action="upload_handler.php" method="POST" enctype="multipart/form-data">

                <label>Video title</label>
                <input type="text" name="title" required>

                <label>Description</label>
                <textarea name="description" rows="5"></textarea>

                <label>Thumbnail</label>
                <input type="file" name="thumbnail" accept="image/*" required>

                <label>Video File</label>
                <input type="file" name="video" accept="video/*" required>

                <button type="submit">Upload</button>
            </form>

        </div>

    </main> 

</div>

</body>
</html> 