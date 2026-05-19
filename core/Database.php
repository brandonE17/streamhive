<?php
session_start();



$host = "localhost";
$port = 3307; 
$user = "root";
$pass = "";
$dbname = "streamhive";

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
     "Databaseverbinding succesvol!";
} catch (PDOException $e) {
     "Fout bij verbinden: " . $e->getMessage();
}
