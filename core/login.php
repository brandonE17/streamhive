<?php
session_start();

require_once __DIR__ . '/../app/models/UserModel.php';
$db = include __DIR__ . '/Database.php';
$userModel = new UserModel($db);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['psw'] ?? '';

    if (!$email || empty($password)) {
        $error = 'Vul een geldig e-mailadres en wachtwoord in.';
    } else {
        $user = $userModel->getUserByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $error = 'E-mail of wachtwoord onjuist.';
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['email'];

            header('Location: ../index.html');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="login.php" method="post">
        <div class="container">
            <h1>Login</h1>
            <p>Vul je gegevens in om in te loggen.</p>
            <hr>

            <?php if ($error): ?>
                <div style="color: red; margin-bottom: 16px;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <label for="email"><b>E-mail</b></label>
            <input type="text" placeholder="Enter Email" name="email" id="email" required>

            <label for="psw"><b>Wachtwoord</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
            <hr>

            <button type="submit" class="registerbtn">Login</button>
        </div>

        <div class="container signin">
            <p>Nog geen account? <a href="../index.html">Registreer hier</a>.</p>
        </div>
    </form>
</body>
</html>
 