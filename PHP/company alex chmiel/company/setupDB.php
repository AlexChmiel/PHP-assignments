<?php
include('db_login.php');
// Connect
$con = mysql_connect( $db_hostname, $db_username, $db_password );
echo 'after sql connect ';
if (!$con)
  {
  echo 'Could not connect: ' . mysql_error();
  }

// Creating table


$sql = 'DROP DATABASE if exists company';
if (mysql_query($sql, $con)) {
    echo "Database my_db was successfully dropped <br>\n";
} else {
    echo 'Error dropping database: ' . mysql_error() . "\n";
}
$sql = "CREATE DATABASE company";
if (mysql_query($sql, $con)) {
    echo "Database my_db was successfully created <br>\n";
} else {
    echo 'Error creating database: ' . mysql_error() . "\n";
}
mysql_select_db("company", $con);

$sql = "CREATE TABLE IF NOT EXISTS products (
         productID    INT UNSIGNED  NOT NULL AUTO_INCREMENT,
         name         VARCHAR(30)   NOT NULL DEFAULT '',
         quantity     INT UNSIGNED  NOT NULL DEFAULT 0,
         price        DECIMAL(7,2)  NOT NULL DEFAULT 99999.99,
         imagefilename    VARCHAR(30)   NOT NULL DEFAULT '',
         PRIMARY KEY  (productID)
       )";

if (mysql_query($sql, $con)) 
{
    echo "Create table products\n <br>";
} 
else 
{
    echo 'Error creating table: ' . mysql_error() . "\n";
}
$sql = "CREATE TABLE IF NOT EXISTS orders (

 orderID INT UNSIGNED NOT NULL AUTO_INCREMENT,

 name VARCHAR(40) NOT NULL,

 total DECIMAL(7,2) NOT NULL DEFAULT 99999.99,

 PRIMARY KEY (orderID)

 )";

// Execute query

if (mysql_query($sql, $con)) 
{

 echo "Create table orders\n <br>";

} 
else 

{
 echo 'Error creating table: ' . mysql_error() . "\n";

}

if (mysql_query($sql, $con)) {
    echo "Create table products\n <br>";
} else {
    echo 'Error creating table: ' . mysql_error() . "\n";
}
$sql="INSERT INTO products (name, quantity, price, imagefilename)
VALUES
('car 1','5','40.000','image1.jpeg')";

$sql = "CREATE TABLE IF NOT EXISTS Customer (
 customerID INT UNSIGNED NOT NULL AUTO_INCREMENT,
 name VARCHAR(40) NOT NULL,
 age INT UNSIGNED NOT NULL DEFAULT 0,
 Address VARCHAR(60),
 PRIMARY KEY (customerID)
);";



if (mysql_query($sql, $con)) 
{

 echo "Create table customer\n <br>";

} 
else 

{
 echo 'Error creating table: ' . mysql_error() . "\n";

}

// Insert 3 records
if (mysql_query($sql, $con)) {
    echo "Added record to products\n <br>";
} else {
    echo 'Error adding a record: ' . mysql_error() . "\n";
}
$sql="INSERT INTO products (name, quantity, price, imagefilename)
VALUES
('car 2','5','56.000','image2.jpeg')";


if (mysql_query($sql, $con)) {
    echo "Added record to products\n <br>";
} else {
    echo 'Error adding a record: ' . mysql_error() . "\n";
}
$sql="INSERT INTO products (name, quantity, price, imagefilename)
VALUES
('car 3','5','56.000','image3.jpeg')";


if (mysql_query($sql, $con)) {
    echo "Added record to products\n <br>";
} else {
    echo 'Error adding a record: ' . mysql_error() . "\n";
}

mysql_close($con);

echo "    Database setup program complete";
?> 
