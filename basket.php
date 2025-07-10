<?php
session_start(); // Start the session
include("db.php");

$pagename = "Smart Basket";
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>";
echo "<title>" . $pagename . "</title>";
echo "<body>";
include("headfile.html");
echo "<h4>" . $pagename . "</h4>";

//if the posted ID of the new product is set i.e. if the user is adding a new product into the basket
if (isset($_POST['h_prodid'])) {
    //capture the ID of selected product using the POST method and the $_POST superglobal variable
//and store it in a new local variable called $newprodid
    $newprodid = $_POST['h_prodid'];
    //capture the required quantity of selected product using the POST method and $_POST superglobal variable
//and store it in a new local variable called $reququantity
    $reququantity = $_POST['p_quantity'];
    //Display id of selected product
    echo "<p>Id of selected product: " . $newprodid;
    //Display quantity of selected product
    echo "<br>Quantity of selected product: " . $reququantity;
    //create a new cell in the basket session array. Index this cell with the new product id.
//Inside the cell store the required product quantity
    $_SESSION['basket'][$newprodid] = $reququantity;
    //Display "1 item added to the basket " message
    echo "<p>1 item added";
}
//else
//Display "Current basket unchanged " message
else {
    echo "<p>Basket unchanged";
}
// Initialize total to zero
$total = 0;

// Check if the session array $_SESSION['basket'] is set and not empty
if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])) {
    echo "<table border='1'>";
    echo "<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr>";

    // Loop through each item in the basket
    foreach ($_SESSION['basket'] as $index => $value) {
        // Validate the product ID
        if (!is_numeric($index)) {
            continue; // Skip if index is not a number
        }

        $prodId = intval($index); // Sanitize the product ID
        $SQL = "SELECT * FROM Product WHERE prodId=$prodId";
        $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));

        // Check if the product exists
        if (mysqli_num_rows($exeSQL) > 0) {
            $arrayp = mysqli_fetch_array($exeSQL);

            echo "<tr>";
            echo "<td>" . $arrayp['prodName'] . "</td>";
            echo "<td>" . $arrayp['prodPrice'] . "</td>";
            echo "<td>" . $value . "</td>";

            $subtotal = $arrayp['prodPrice'] * $value;
            echo "<td>" . $subtotal . "</td>";
            echo "</tr>";

            $total += $subtotal;
        }
    }

    // Display total
    echo "<tr><td colspan='3'><b>Total</b></td><td><b>" . $total . "</b></td></tr>";
    echo "</table>";
} else {
    // Display empty basket message
    echo "<p>Your basket is empty</p>";
}

include("footfile.html");
echo "</body>";
?>