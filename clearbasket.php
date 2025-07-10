<?php
session_start();
include("db.php");

unset($_SESSION['basket']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clear Smart Basket</title>
    <link rel="stylesheet" type="text/css" href="mystylesheet.css">
</head>
<body>
    <?php include("headfile.html"); ?>
    <h4>Clear Smart Basket</h4>
    <p>Your basket has been cleared</p>
    <?php include("footfile.html"); ?>
</body>
</html>
