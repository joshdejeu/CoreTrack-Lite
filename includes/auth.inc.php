<?php
session_start(); // Start the session to check login status

// Check if the user is logged in
if (!isset($_SESSION["dealer_code"])) {
    // Not logged in, redirect to login page
    header("Location: ../index.php");
    exit;
}