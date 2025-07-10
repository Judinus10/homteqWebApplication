<?php
session_start(); // Start the session

include("db.php");

$pagename = "Smart Basket";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include("headfile.html");
echo "<h4>".$pagename."</h4>";

// Initialize total to zero
$total = 0;

// Check if the session array $_SESSION['basket'] is set
if(isset($_SESSION['basket'])) {
    // Create a HTML table with a header to display the content of the shopping basket
    echo "<table border='1'>";
    echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr>";

    // Loop through the basket session array using a foreach loop
    foreach($_SESSION['basket'] as $index => $value) {
        // SQL query to retrieve details of selected product
        $SQL = "SELECT * FROM Product WHERE prodId=$index";
        // Execute query
        $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
        // Fetch product details
        $arrayp = mysqli_fetch_array($exeSQL);

        // Display product details in table rows
        echo "<tr>";
        echo "<td>".$arrayp['prodName']."</td>"; // Product name
        echo "<td>".$arrayp['prodPrice']."</td>"; // Product price
        echo "<td>".$value."</td>"; // Quantity
        // Calculate subtotal
        $subtotal = $arrayp['prodPrice'] * $value;
        echo "<td>".$subtotal."</td>"; // Subtotal
        echo "</tr>";

        // Update total
        $total += $subtotal;
    }

    // Display total
    echo "<tr><td colspan='3'>Total</td><td>".$total."</td></tr>";

    echo "</table>";
} else {
    // Display empty basket message
    echo "<p>Your basket is empty</p>";
}

include("footfile.html");
echo "</body>";
?>
