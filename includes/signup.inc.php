<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Trim (remove whitespace before/after) & sanitize input
    $username = trim($_POST["username"]);
    $pwd = trim($_POST["password"]);
    $dealerCode = trim($_POST["dealercode"]);

    try {
        require_once "dbh.inc.php";
        // Check for existing username
        $query = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $userExists = $stmt->fetchColumn(); // Returns the count, either 0 or 1

        if ($userExists > 0) {
            // Send 'username taken' error to client
            echo json_encode(["error" => "Username is already taken."]);
            exit; // Stop further script execution
        }

        // Insert new user
        $query = "INSERT INTO users (username, pwd, dealer_code) VALUES (:username, :pwd, :dealerCode);";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        // Hash password before storing it
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $stmt->bindParam(":pwd", $hashedPwd);
        $stmt->bindParam("dealerCode", $dealerCode);

        $stmt->execute();
        $pdo = null;
        $stmt = null;

        // Start session and store user data
        session_start();
        session_regenerate_id(true); // Prevent fixation
        $_SESSION["dealer_code"] = $dealerCode; // Mark user as logged in

        // Send success response as JSON and redirect to admin page
        echo json_encode([
            "success" => "User created successfully!",
            "redirect" => "./includes/coretrack-admin.php" // Authorized admin page
        ]);
        exit;
        // Use for anything with connection, exit() for anything non-connected

    } catch (Exception $e) {
        echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
        exit;
    }
} else {
    // Request wasn't made with POST
    echo json_encode(["error" => "Invalid request method."]);
    header("Location: ../index.php");
    exit;
}