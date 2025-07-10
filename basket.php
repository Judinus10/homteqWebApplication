<?php
session_start();
include("db.php");

$pagename = "Smart Basket";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include("headfile.html");
echo "<h4>".$pagename."</h4>";

$total = 0;

if(isset($_SESSION['basket'])) {
    echo "<table border='1'>";
    echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr>";

    foreach($_SESSION['basket'] as $index => $value) {
        $SQL = "SELECT * FROM Product WHERE prodId=?";
		$stmt = mysqli_prepare($conn, $SQL);
		mysqli_stmt_bind_param($stmt, "i", $index); // Assuming $index is an integer
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		// Fetch product details
		$arrayp = mysqli_fetch_array($result);

		// Check if $arrayp is not null before accessing its elements
		if ($arrayp !== null) {
			// Display product details
			echo "<tr>";
			echo "<td>".$arrayp['prodName']."</td>"; // Product name
			echo "<td>".$arrayp['prodPrice']."</td>"; // Product price
			echo "<td>".$value."</td>"; // Quantity
			$subtotal = $arrayp['prodPrice'] * $value;
			echo "<td>".$subtotal."</td>"; // Subtotal
			echo "</tr>";

			// Update total
			$total += $subtotal;
		} else {
			// Handle case where $arrayp is null
			echo "Product details not found.";
		}
    }

    echo "<tr><td colspan='3'>Total</td><td>".$total."</td></tr>";
    echo "</table>";
} else {
    echo "<p>Your basket is empty</p>";
}

echo "<a href='clearbasket.php'>Clear Basket</a>";

include("footfile.html");
echo "</body>";
?>
