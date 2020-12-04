<?php

// Assigning variables to credentials to connect to database 
$mysql_host="localhost"; 
$mysql_user="root";
$mysql_password="";
$db_database = "grabify";

/**
 * Printing error message for debugging 
 *
 * @param String $message obtaining the message provided by the SQL server 
 * 
 * @return String Error message will be displayed for debugging purposes
 */

function printerror($message, $con) {
    echo "<pre>";
    echo "$message<br>";
    if ($con) {
        echo "FAILED: ". mysqli_error($con) . "<br>";
    } 
    echo "</pre>";
}

/**
 * Printing a message to show that the database is connected successfully 
 *
 * @param String $message obtaining the message provided by the SQL server 
 * 
 * @return String Message will be display to verify that the application has connected to the database
 */

function printok($message) {
    echo "<pre>";
    echo "--------------------------------------------<br>";
    echo "$message<br>";
    echo "OK<br>";
    echo "</pre>";
}

/**
 * Attempting to connect to the database   
 * 
 * @param String $mysql_host     Retriving the location of the SQL server
 * @param String $mysql_user     Retriving the username to access the SQL server 
 * @param String $mysql_password Retriving the password to access the SQL server 
 * @param String $db_database    Retriving the name of the database to connect to 
 * 
 * @return String Error messages will be displayed if user input does not match the pattern specify in Regex
 */

try {
    $con=mysqli_connect($mysql_host,$mysql_user,$mysql_password); // login to database server
}
catch (Exception $e) {
    printerror($e->getMessage(),$con); //return connection fail and display error messages 
}
if (!$con) {
    printerror("Connecting to $mysql_host", $con);
    die();
}
else printok("Connecting to $mysql_host");

$conDB=mysqli_select_db($con, $db_database);
if (!$conDB) {
    printerror("Selecting $db_database",$con);
    die();
}
else printok("Selecting $db_database");
