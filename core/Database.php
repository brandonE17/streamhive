<?php
session_start();



$host = "localhost";
$port = 3307; 
$user = "root";
$pass = "";
$dbname = "readyornot";

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    echo "Databaseverbinding succesvol!";
} catch (PDOException $e) {
    echo "Fout bij verbinden: " . $e->getMessage();
}
