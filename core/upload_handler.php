<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../app/models/VideoModel.php';
$db = include __DIR__ . '/Database.php';

$videoModel = new VideoModel($db);

$error = '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: upload.php');
    exit;
} 

function getUploadErrorMessage(array $file, string $label): string {
    switch ($file['error'] ?? UPLOAD_ERR_NO_FILE) {
        case UPLOAD_ERR_OK:
            return '';
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return "Het bestand voor $label is te groot.";
        case UPLOAD_ERR_PARTIAL:
            return "Het bestand voor $label is slechts gedeeltelijk geüpload.";
        case UPLOAD_ERR_NO_FILE:
            return "Je hebt geen bestand geselecteerd voor $label.";
        case UPLOAD_ERR_NO_TMP_DIR:
            return "De tijdelijke uploadmap ontbreekt op de server.";
        case UPLOAD_ERR_CANT_WRITE:
            return "Het bestand voor $label kon niet worden opgeslagen.";
        case UPLOAD_ERR_EXTENSION:
            return "Een serverextensie blokkeert de upload van $label.";
        default:
            return "Er is een fout opgetreden bij het uploaden van $label.";
    }
}

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$thumbnail = $_FILES['thumbnail'] ?? null;
$video = $_FILES['video'] ?? null;

if ($title === '') {
    $error = 'Vul een titel in voor de video.';
} elseif (!$thumbnail || !isset($thumbnail['error']) || $thumbnail['error'] !== UPLOAD_ERR_OK) {
    $error = getUploadErrorMessage($thumbnail ?? ['error' => UPLOAD_ERR_NO_FILE], 'de thumbnail');
} elseif (!$video || !isset($video['error']) || $video['error'] !== UPLOAD_ERR_OK) {
    $error = getUploadErrorMessage($video ?? ['error' => UPLOAD_ERR_NO_FILE], 'de video');
}

$allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$allowedVideoTypes = ['video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/x-matroska', 'video/webm'];

if (!$error) {
    if (!in_array($thumbnail['type'], $allowedImageTypes, true)) {
        $error = 'Ongeldig bestandsformaat voor thumbnail. Gebruik JPG, PNG, GIF of WEBP.';
    } elseif (!in_array($video['type'], $allowedVideoTypes, true)) {
        $error = 'Ongeldig bestandsformaat voor video. Gebruik MP4, MOV, AVI, MKV of WEBM.';
    }
}

if (!$error) {
    $uploadBase = dirname(__DIR__) . '/upload';
    $thumbDir = $uploadBase . '/thumbnails';
    $videoDir = $uploadBase . '/videos';

    if (!is_dir($thumbDir) && !mkdir($thumbDir, 0755, true) && !is_dir($thumbDir)) {
        $error = 'Kan uploadmap voor thumbnails niet aanmaken.';
    }
    if (!is_dir($videoDir) && !mkdir($videoDir, 0755, true) && !is_dir($videoDir)) {
        $error = 'Kan uploadmap voor video niet aanmaken.';
    }
}

if (!$error) {
    $sanitizeFileName = function (string $filename): string {
        $filename = preg_replace('/[^A-Za-z0-9._-]/', '_', $filename);
        $filename = preg_replace('/_+/', '_', $filename);
        return trim($filename, '_');
    };

    $thumbnailName = uniqid('thumb_', true) . '_' . $sanitizeFileName(basename($thumbnail['name']));
    $videoName = uniqid('video_', true) . '_' . $sanitizeFileName(basename($video['name']));

    $thumbnailPath = $thumbDir . '/' . $thumbnailName;
    $videoPath = $videoDir . '/' . $videoName;

    if (!move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath)) {
        $error = 'Kon de thumbnail niet opslaan.';
    } elseif (!move_uploaded_file($video['tmp_name'], $videoPath)) {
        $error = 'Kon de video niet opslaan.';
    }
}

if (!$error) {
    $thumbnailDb = 'upload/thumbnails/' . $thumbnailName;
    $videoDb = 'upload/videos/' . $videoName;

    try {
        $videoModel->saveVideo($title, $description, $thumbnailDb, $videoDb, (int)$_SESSION['user_id']);
        header('Location: ../index.php');
        exit;
    } catch (PDOException $e) {
        $error = 'Fout bij het opslaan van video in de database: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload fout</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h1>Upload mislukt</h1>
    <p style="color: red;"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <p><a href="upload.php">Ga terug naar uploaden</a></p>
</div>
</body>
</html>
