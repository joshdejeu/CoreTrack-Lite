<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Trim (remove whitespace before/after) & sanitize input
    $username = trim($_POST["username"]);
    $pwd = trim($_POST["password"]);

    try {
        require_once "dbh.inc.php";
        // Check for existing username
        // Get hashed password for user
        $query = "SELECT pwd FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username); // Bind username
        $stmt->execute();
        $storedHash = $stmt->fetchColumn(); // Fetch the hashed password

        // Check if username exists in the database
        if ($storedHash && password_verify($pwd, $storedHash)) {
            // Verify the input password against the stored hash
            // Password correct

            // Start session and store user dealer_code
            $query = "SELECT dealer_code FROM users WHERE username = :username";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":username", $username); // Bind username
            $stmt->execute();
            $dealerCode = $stmt->fetchColumn(); // Get scalar value directly

            // Start session and store dealer_code
            session_start();
            session_regenerate_id(true); // Prevent fixation
            $_SESSION["dealer_code"] = $dealerCode; // Store dealer_code

            // Return success with redirect URL
            echo json_encode([
                "success" => "Successful login!",
                "redirect" => "./includes/coretrack-admin.php" // Authorized admin page
            ]);
            exit;
        } else {
            // Username not found OR Incorrect password
            echo json_encode(value: ["error" => "Username or password is incorrect."]);
        }
        $pdo = null;
        $stmt = null;
        exit;
    } catch (Exception $e) {
        // SQL query error
        // echo json_encode(["error" => "Username or password is incorrect."]);
        echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
        exit;
    }
} else {
    // Request wasn't made with POST
    echo json_encode(["error" => "Invalid request method."]);
    header("Location: ../index.php");
    exit;
}