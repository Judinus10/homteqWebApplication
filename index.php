<?php
include ("db.php"); //include db.php file to connect to DB

$pagename="Make your home smart"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";

echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";

//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="SELECT prodId, prodName, prodDescripShort, prodPrice, prodPicNameSmall FROM Product";
//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

echo "<table style='border: 0px'>";
//create an array of records (2 dimensional variable) called $arrayp.
//populate it with the records retrieved by the SQL query previously executed.
//Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp=mysqli_fetch_array($exeSQL))
{
	echo "<tr>";
	echo "<td style='border: 0px'>";
	//display the small image whose name is contained in the array
	echo "<a href=prodbuy.php?u_prod_id=".$arrayp['prodId'].">";
	echo "<img src=assets/images/".$arrayp['prodPicNameSmall']." height=200 width=200>";
	echo "</a>";
	echo "</td>";
	echo "<td style='border: 0px'>";
	echo "<p><h5>".$arrayp['prodName']."</h5><br> "; //display product name as contained in the array
	echo "<p>".$arrayp['prodDescripShort']."<br>";
	echo "<p>&pound".$arrayp['prodPrice'];
	echo "</td>";
	echo "</tr>";
}
echo "</table>";

echo "<p>Number to be purchased: ";

//create form made of one text field and one button for user to enter quantity
//the value entered in the form will be posted to the basket.php to be processed
echo "<form action=basket.php method=post>";
echo "<input type=text name=p_quantity size=5 maxlength=3>";
echo "<input type=submit name='submitbtn' value='ADD TO BASKET' id='submitbtn'>";
//pass the product id to the next page basket.php as a hidden value
echo "<input type=hidden name=h_prodid value=".$prodid.">";
echo "</form>";
echo "</p>";

include ("footfile.html");
echo "</body>";
?>
