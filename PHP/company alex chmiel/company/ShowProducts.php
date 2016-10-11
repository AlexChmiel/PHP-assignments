<html>
   <head>
      <title>The jQuery Example</title>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	  <style>
a.selected {
  background-color:#1F75CC;
  color:white;
  z-index:100;
}

.messagepop {
  background-color:#FFFFFF;
  border:1px solid #999999;
  cursor:default;
  display:none;
  margin-top: 15px;
  position:absolute;
  text-align:left;
  width:394px;
  z-index:50;
  padding: 25px 25px 20px;
}

label {
  display: block;
  margin-bottom: 3px;
  padding-left: 15px;
  text-indent: -15px;
}

.messagepop p, .messagepop.div {
  border-bottom: 1px solid #EFEFEF;
  margin: 8px 0;
  padding-bottom: 8px;
}
</style>
      <script type="text/javascript" language="javascript">
         function addToCart(id,fieldname){
            var num = document.getElementById(fieldname).value;
            $.post( 
                  "updatecart.php",
                  { prodid: id,
                    qty: num },
                  function(data) {
                    // uncomment this line to see php response 
 //$('#stage').html(data);
                  }
               );
         }
   </script>
 
   </head>
<body>	
<div id="stage" style="background-color:cc0;">
         STAGE
      </div>
	  
	  <form action="ShowProducts.php" method="post">
<div id="userdetails">
Username:<input type="text" name="username" id="username" value="" />
 <input type="submit" value="Login">
</form>	
<?php
// Start the session
session_start();

if (isset($_POST["username"]))
{
$_SESSION["username"] = $_POST["username"];

}
if (isset($_SESSION["username"])){
    $username = $_SESSION["username"]; 
}

require_once 'db_login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());

$query = "SELECT * FROM products";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());

$rows = mysql_num_rows($result);
echo "<table border=1><tr> <th>description</th> <th>Price</th><th>Image</th></tr>";
$count=1;
for ($i = 0; $i < 6; $i++)
{
		{
		$row = mysql_fetch_assoc($result);  
		echo "<tr>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row["price"]."</td>";
		echo '<td><img src="images/'.$row["imagefilename"].'" alt="Smiley face" height="100" width="100">' ."</td>";
		echo '<td><span>Quantity</span>';
		echo  '<input type="text" size="2" maxlength="2" id="qty'.$count.'" value="1" /></td>';
    
		echo '<input type="hidden" name="id" value="'.$row['productID'].'"/>';
		echo '<td><input type="button" id="driver" value="Buy" onclick="addToCart(';
		echo ''.$row['productID'].','."'qty".$count."')".'"/></td>'; 
		echo "</tr>";
		$count++;
}

echo "</table>";
echo '<form method="post" action="displaycart.php">';
echo '<button type="submit">Display Cart</button></form>'; 
?>

</body>
	
</html>
