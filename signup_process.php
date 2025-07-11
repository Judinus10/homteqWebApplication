<?php
session_start();
include("db.php");
mysqli_report(MYSQLI_REPORT_OFF); // Disable automatic error messages for manual handling

$pagename = "Sign Up Result";
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>";
echo "<title>$pagename</title>";
echo "<body>";
include("headfile.html");
echo "<h4>$pagename</h4>";

// Capture and trim the input fields
$fname = trim($_POST['r_firstname']);
$lname = trim($_POST['r_lastname']);
$address = trim($_POST['r_address']);
$postcode = trim($_POST['r_postcode']);
$telno = trim($_POST['r_telno']);
$email = trim($_POST['r_email']);
$password1 = trim($_POST['r_password1']);
$password2 = trim($_POST['r_password2']);

// Regular expression for email validation
$reg = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";

// 1. Check if any required field is empty
if (
    empty($fname) || empty($lname) || empty($address) || empty($postcode) ||
    empty($telno) || empty($email) || empty($password1) || empty($password2)
) {
    echo "<br><p><b>Sign-up failed!</b></p>";
    echo "<br><p>Your signup form is incomplete and all fields are mandatory.</p>";
    echo "<br><p>Go back to <a href='signup.php'>sign up</a></p><br><br><br><br>";
}
// 2. Check if passwords match
elseif ($password1 !== $password2) {
    echo "<br><p><b>Sign-up failed!</b></p>";
    echo "<br><p>The 2 passwords do not match. Please enter them correctly.</p>";
    echo "<br><p>Go back to <a href='signup.php'>sign up</a></p><br><br><br><br>";
}
// 3. Check if email is valid
elseif (!preg_match($reg, $email)) {
    echo "<br><p><b>Sign-up failed!</b></p>";
    echo "<br><p>Email not valid. Please enter a correct email address.</p>";
    echo "<br><p>Go back to <a href='signup.php'>sign up</a></p><br><br><br><br>";
}
// 4. All validations passed, try inserting into DB
else {
    $SQL = "INSERT INTO Users 
    (userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword) 
    VALUES 
    ('C', '$fname', '$lname', '$address', '$postcode', '$telno', '$email', '$password1')";

    if (mysqli_query($conn, $SQL)) {
        echo "<p><b>Sign-up successful!</b></p><br>";
        echo "<br><p>To continue, please <a href='login.php'>login</a></p><br>";
    } else {
        echo "<p><b>Sign-up failed!</b></p>";
        // Error code 1062: Duplicate email (unique constraint violation)
        if (mysqli_errno($conn) == 1062) {
            echo "<br><p>Email already in use. You may be already registered or try another email address.</p><br>";
        }
        // Error code 1064: Invalid characters in SQL
        elseif (mysqli_errno($conn) == 1064) {
            echo "<br><p>Invalid characters entered in the form.</p>";
            echo "<br><p>Avoid using apostrophes like [ ' ] or backslashes like [ \\ ]</p><br>";
        }
        // Generic error
        else {
            echo "<br><p>An unexpected error occurred. Please try again later.</p><br>";
            // Optional for debugging:
            // echo "<p>Error Code: " . mysqli_errno($conn) . "</p>";
            // echo "<p>Error Message: " . mysqli_error($conn) . "</p>";
        }

        echo "<br><p>Go back to <a href='signup.php'>sign up</a></p><br><br><br><br>";
    }
}

include("footfile.html");
echo "</body>";
?>
