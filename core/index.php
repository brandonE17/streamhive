<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['psw'] ?? '';
    $passwordRepeat = $_POST['psw-repeat'] ?? '';

    if (!$email) {
        die('Ongeldig e-mailadres.');
    }

    if (empty($password) || $password !== $passwordRepeat) {
        die('Wachtwoorden komen niet overeen of zijn leeg.');
    }

    $db = include __DIR__ . '/Database.php';
    require_once __DIR__ . '/../app/models/UserModel.php';

    $userModel = new UserModel($db);

    try {
        $userId = $userModel->registerUser($email, $password);
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $email;

        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        die('Fout bij registratie: ' . $e->getMessage());
    }
}

if (!empty($_SESSION['username'])) {
    echo 'U bent ingelogd als: ' . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . '<br>';
}
?>