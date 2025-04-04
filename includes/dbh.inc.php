<?php

$host = getenv("DATABASE_HOST");
$dbname = getenv("DATABASE_NAME");

$dsn = "mysql:host=$host;dbname=$dbname";
$dbusername = getenv("DATABASE_USER");
$dbpassword = getenv("DATABASE_PASSWORD");

// mysqli - mysql db
// pdo - sqllite
try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword); // attempt db connection
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // if error, throw exception
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

