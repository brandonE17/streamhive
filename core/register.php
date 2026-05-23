<?php
session_start();

require_once __DIR__ . '/../app/models/UserModel.php'; 
$db = include __DIR__ . '/Database.php';

$userModel = new UserModel($db);

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['psw'] ?? '';
    $passwordRepeat = $_POST['psw-repeat'] ?? '';

    if (!$email) {
        $error = 'Ongeldig e-mailadres.';
    } elseif ($password === '' || $password !== $passwordRepeat) {
        $error = 'Wachtwoorden komen niet overeen.';
    } else {
        try {
            $userId = $userModel->registerUser($email, $password);

            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $email;

            header('Location: ../core/login.php');
            exit; 

        } catch (PDOException $e) {
            $error = 'Fout bij registratie: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<form action="register.php" method="post">
    <div class="container">
        <h1>Registreren</h1>
        <p>Maak een nieuw account.</p>
        <hr>
    
        <?php if ($error): ?>
            <div style="color:red; margin-bottom:16px;">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <label for="email"><b>E-mail</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="psw"><b>Wachtwoord</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

        <label for="psw-repeat"><b>Herhaal Wachtwoord</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>

        <hr>

        <button type="submit" class="registerbtn">Registreren</button>
    </div>

    <div class="container signin">
        <p>Heb je al een account? <a href="login.php">Log hier in</a>.</p>
    </div>
</form>

</body>
</html>