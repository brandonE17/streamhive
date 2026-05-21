<?php
$host = "localhost";
$port = 3307;
$user = "root";
$pass = "";
$dbname = "streamhive";

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
} catch (PDOException $e) {
    die("Fout bij verbinden: " . $e->getMessage());
}

