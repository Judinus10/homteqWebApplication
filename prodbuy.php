<?php
session_start();

include("db.php");

$pagename="A smart buy for a smart home"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("headfile.html"); //include header layout file
include ("detectlogin.php");

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//retrieve the product id passed from previous page using the GET method and the $_GET superglobal variable
//applied to the query string u_prod_id
//store the value in a local variable called $prodid
$prodid=$_GET['u_prod_id'];

//display the value of the product id, for debugging purposes
echo "<p>Selected product Id: ".$prodid;

// Create SQL query to retrieve product details including large image, long description, price, and quantity available in stock
$SQL = "SELECT prodId, prodName, prodPicNameLarge, prodDescripLong, prodPrice, prodQuantity FROM Product WHERE prodId=$prodid";

// Run SQL query
$exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));

// Fetch the product details
if ($arrayp = mysqli_fetch_array($exeSQL)) {
    echo "<table style='border: 0px'>";
    echo "<tr>";
    echo "<td style='border: 0px'>";
    // Display the large image
    echo "<img src=assets/images/".$arrayp['prodPicNameLarge']." height=300 width=300>";
    echo "</td>";
    echo "<td style='border: 0px'>";
    echo "<p><h2>".$arrayp['prodName']."</h2><br> ";// Display product name
    echo "<p>".$arrayp['prodDescripLong']."</p><br> "; // Display long description
    echo "<p><b>Price: $".$arrayp['prodPrice']."</b></p><br> "; // Display product price
    echo "<p><b>Items in stock: ".$arrayp['prodQuantity']."</b></p>"; // Display quantity available in stock
    
	echo "<br><p>Number to be purchased: <br><br>";

	//create form made of one text field and one button for user to enter quantity
	//the value entered in the form will be posted to the basket.php to be processed
	echo "<form action=basket.php method=post>";
//echo "<input type=text name=p_quantity size=5 maxlength=3>";

	echo "<select name='p_quantity'>";
    // Create loop to iterate from 1 to the stock level
    for ($i = 1; $i <= $arrayp['prodQuantity']; $i++) {
        echo "<option value='".$i."'>".$i."</option>"; // Display options
    }
    echo "</select><br><br>";
	
	echo "<input type=submit name='submitbtn' value='ADD TO BASKET' id='submitbtn'>";
	//pass the product id to the next page basket.php as a hidden value
	echo "<input type=hidden name=h_prodid value=".$prodid.">";
	echo "</form>";
	echo "</p>";

	echo "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    echo "Product not found.";
}

include("footfile.html"); //include head layout

echo "</body>";
?>