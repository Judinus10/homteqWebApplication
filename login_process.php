<?php
session_start();
include("db.php");

$pagename = "Your Login Result"; //Create and populate a variable called $pagename
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>"; //Call in stylesheet
echo "<title>" . $pagename . "</title>"; //display name of the page as window title
echo "<body>";
include("headfile.html"); //include header layout file
echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

// Capture the login details from form
$email = trim($_POST['l_email']);
$password = trim($_POST['l_password']);

// If either the email or password fields are empty
if (empty($email) || empty($password)) {
    echo "<p><b>Login failed!</b></p>";
    echo "<p>Login form incomplete. Please provide both email and password.</p>";
    echo "<p>Go back to <a href='login.php'>login</a></p>";
}
// If all fields are filled
else {
    // SQL query to check if a user exists with the provided email
    $SQL = "SELECT * FROM Users WHERE userEmail = '$email'";
    $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
    $nbrecs = mysqli_num_rows($exeSQL);

    // If no user with that email exists
    if ($nbrecs == 0) {
        echo "<p><b>Login failed!</b></p>";
        echo "<p>Email not recognised. Please try again.</p>";
        echo "<p>Go back to <a href='login.php'>login</a></p>";
    } else {
        $arrayuser = mysqli_fetch_array($exeSQL);
        // If password does not match
        if ($arrayuser['userPassword'] !== $password) {
            echo "<p><b>Login failed!</b></p>";
            echo "<p>Password not valid. Please try again.</p>";
            echo "<p>Go back to <a href='login.php'>login</a></p>";
        } 
        // Successful login
        else {
            echo "<p><b>Login successful!</b></p>";

            // Set session variables
            $_SESSION['userid'] = $arrayuser['userId'];
            $_SESSION['fname'] = $arrayuser['userFName'];
            $_SESSION['sname'] = $arrayuser['userSName'];
            $_SESSION['usertype'] = $arrayuser['userType'];

            // Welcome message
            echo "<p>Welcome, " . $_SESSION['fname'] . " " . $_SESSION['sname'] . "</p>";

            // Display user type
            if ($_SESSION['usertype'] == 'C') {
                echo "<p>User Type: homteq Customer</p>";
            }
            if ($_SESSION['usertype'] == 'A') {
                echo "<p>User Type: homteq Administrator</p>";
            }

            // Navigation links
            echo "<br><p>Continue shopping for <a href='index.php'>Home Tech</a></p>";
            echo "<p>View your <a href='basket.php'>Smart Basket</a></p>";
        }
    }
}

include("footfile.html");
echo "</body>";
?>
