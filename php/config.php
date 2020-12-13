<?php

// Assigning variables to credentials to connect to database 
$mysql_host="localhost"; 
$mysql_user="root";
$mysql_password="";
$db_name = "grabify";

$con = new mysqli(
    $mysql_host,
    $mysql_user,
    $mysql_password
); // login to database server

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
} 

// returns true/false, true if successful, false if failed
$isok = mysqli_select_db($con, $db_name);
if ($isok) {
    //echo "mysqli_select_db successful<br>";
} else {
   // echo "mysqli_select_db FAILED ";
    die(mysqli_error($con)); //return error is connect fail
}
?>


