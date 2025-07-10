<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit;
}

// Retrieve session attributes
$username = $_SESSION['username'];
$user_level = $_SESSION['user_level'];

// Display home page with session attributes
echo "<h2>Welcome, $username!</h2>";
echo "<p>Your user level is: $user_level</p>";
?>
