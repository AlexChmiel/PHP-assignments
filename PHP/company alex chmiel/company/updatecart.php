<?php

if (isset($_POST["prodid"]))
{
session_start();
if (!isset($_SESSION["cart"]))
   $_SESSION["cart"] = array();
require_once 'db_login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());

$query = "SELECT * FROM products where productID=".$_POST["prodid"];
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());

$rows = count($_SESSION["cart"]); // Number of elements in cart = rows
$cnt=0;
$found =0;

while ($cnt < $rows) { 

 $row = $_SESSION["cart"][$cnt]; 

 

 if ($row["productID"] == $_POST["prodid"]){ If product ID in a row is equal to this row , add product 

 $found = 1;

 $_SESSION["cart"][$cnt]["qty"] += $_POST["qty"]; // Quantity products is going to be  added to the cart
	break;

 }
$cnt++;  
}

if ($found == 0) // If finds nothing

 while ($row = mysql_fetch_assoc($result)) { // While row = to result of the fetch from mysql

 $row['qty'] = $_POST["qty"]; // Quantity = posted quantity

 array_push($_SESSION["cart"], $row); // Adds new row

 }
$rows = count($_SESSION["cart"]);
$cnt=0;
echo "<table border=1><tr> <th>description</th> <th>quantity</th><th>Image</th></tr>";
while ($cnt < $rows) {
    $row = $_SESSION["cart"][$cnt];
    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row["qty"]."</td>";
    echo '<td><img src="images/'.$row["imagefilename"].'" alt="img" height="100" width="100">' ."</td>";
    
     echo "</tr>";
     $cnt++;
}

echo "</table>";
}
?>
 

