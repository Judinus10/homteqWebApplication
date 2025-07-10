<?php
session_start();

// Define sample username and password (you should replace this with your actual authentication logic)
$valid_username = "user";
$valid_password = "password";

// Retrieve submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Check if submitted username and password match the valid credentials
if ($username === $valid_username && $password === $valid_password) {
    // Set session variables
    $_SESSION['username'] = $username;
    $_SESSION['user_level'] = 'admin'; // You can set the user level as needed

    // Redirect to home page
    header("Location: home.php");
    exit;
} else {
    // Redirect back to login page if credentials do not match
    header("Location: login.html");
    exit;
}
?>
