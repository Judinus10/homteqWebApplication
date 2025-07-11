<?php
session_start();
include("db.php");

$pagename = "Smart Basket";
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>";
echo "<title>" . $pagename . "</title>";
echo "<body>";
include("headfile.html");
include("detectlogin.php");
echo "<h4>" . $pagename . "</h4>";

/* ✅ REMOVE ITEM CODE (as per your pseudocode) */
if (isset($_POST['del_prodid'])) {
    $delprodid = $_POST['del_prodid'];
    unset($_SESSION['basket'][$delprodid]);
    echo "<p>1 item removed</p>";
}

/* ✅ ADD ITEM TO BASKET */
if (isset($_POST['h_prodid']) && isset($_POST['p_quantity'])) {
    $newprodid = $_POST['h_prodid'];
    $reququantity = $_POST['p_quantity'];
    $_SESSION['basket'][$newprodid] = $reququantity;
    echo "<p>1 item added</p>";
}

$total = 0;
echo "<p><table id='baskettable'>";
echo "<tr>";
echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Remove Product</th>";
echo "</tr>";

if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])) {
    foreach ($_SESSION['basket'] as $index => $value) {
        if (!is_numeric($index)) {
            continue;
        }

        $SQL = "SELECT prodId, prodName, prodPrice FROM Product WHERE prodId=" . intval($index);
        $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
        $arrayp = mysqli_fetch_array($exeSQL);

        $subtotal = $arrayp['prodPrice'] * $value;
        $total += $subtotal;

        echo "<tr>";
        echo "<td>" . $arrayp['prodName'] . "</td>";
        echo "<td>&pound" . number_format($arrayp['prodPrice'], 2) . "</td>";
        echo "<td style='text-align:center;'>" . $value . "</td>";
        echo "<td>&pound" . number_format($subtotal, 2) . "</td>";

        // ✅ Proper form inside one <td>
        echo "<td>
                <form action='basket.php' method='post'>
                    <input type='hidden' name='del_prodid' value='" . $arrayp['prodId'] . "'>
                    <input type='submit' value='Remove' id='submitbtn'>
                </form>
              </td>";
        echo "</tr>";
    }

    echo "<tr><td colspan='4'><b>TOTAL</b></td><td><b>&pound" . number_format($total, 2) . "</b></td></tr>";
} else {
    echo "<tr><td colspan='5'>Your basket is empty</td></tr>";
}

echo "</table>";

echo "<br><p><a href='clearbasket.php'>CLEAR BASKET</a></p>";

if (isset($_SESSION['userid'])) {
    echo "<br><p><a href=checkout.php>CHECKOUT</a></p>";
} else {
    echo "<br><p>New homteq customers: <a href='signup.php'>Sign up</a></p>";
    echo "<p>Returning homteq customers: <a href='login.php'>Login</a></p>";
}

include("footfile.html");
echo "</body>";
?>