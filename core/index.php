<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST['email'];
    $psw = $_POST['psw'];

    $_SESSION['username'] = $email;

    header("Location: Database.php"); 
    exit;
} 
 

echo " u bent ingelogd als: " . $_SESSION['username'] . "<br>";



?>