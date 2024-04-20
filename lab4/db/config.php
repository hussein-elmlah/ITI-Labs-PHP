<?php

include 'base.php';

$dbHost = 'localhost';
$dbName = 'php_labs';
$dbUser = 'root';
$dbPassword = 'hussein';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // echo "Connected successfully to database: $dbName";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
