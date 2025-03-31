<?php

$dsn = "mysql:host=localhost;dbname=coretrack";
$dbusername = "root";
$dbpassword = "";

// mysqli - mysql db
// pdo - sqllite
try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword); // attempt db connection
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // if error, throw exception
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

