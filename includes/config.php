<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "ecms";

try {
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database Connection Failed!" . $e->getMessage();
}

session_start();
