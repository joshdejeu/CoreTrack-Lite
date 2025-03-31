<?php
require_once "auth.inc.php"; // Check login session

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Trim (remove whitespace before/after) & sanitize input
    $partNumber = trim($_POST["part_number"]);
    $quantity = (int) $_POST["quantity"];

    try {
        require_once "dbh.inc.php";
        // Submit new core return
        $query = "INSERT INTO core_returns (part_number, quantity, dealer_code) VALUES (:part_number, :quantity, :dealer_code);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ":part_number" => $partNumber,
            ":quantity" => $quantity,
            ":dealer_code" => $_SESSION["dealer_code"]
        ]);
        header("Location: coretrack-admin.php?success=Return submitted");
        $pdo = null;
        $stmt = null;
        exit;
    } catch (Exception $e) {
        // SQL query error
        header("Location: coretrack-admin.php");
        exit;
    }
} else {
    // Request wasn't made with POST
    header("Location: ../index.php");
    exit;
}