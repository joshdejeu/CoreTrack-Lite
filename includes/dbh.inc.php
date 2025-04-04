<?php
$url = parse_url(getenv("JAWSDB_URL"));
$host = $url["host"];
$dbname=substr($url["path"],1);
$username = $url["user"];
$password = $url["pass"];
// $dbusername = getenv("DATABASE_USER");
// $dbpassword = getenv("DATABASE_PASSWORD");

// mysqli - mysql db
// pdo - sqllite
try {
    $pdo = new PDO($dsn, $username, $password); // attempt db connection
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // if error, throw exception
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

