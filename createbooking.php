<?php
session_start();
session_regenerate_id(); //session_regenerate_id();
require('php/config.php');

?>


<html>
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        <?php include 'css/styles.css'; 
         include 'css/navbar.css'; 
         include 'css/login.css';
         include 'css/editbooking.css';
         ?>
  
    </style>
    <script type="text/javascript" src="js/navbar.js"></script>
    <script type="text/javascript" src="js/userlogin.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="js/w3.js"></script>
    

</head>

<body>

<div><?php 

$username= $_SESSION['username'];
$stmt=$con->prepare("SELECT user_id FROM users WHERE username = ?");//Get favorite data from database
$stmt->bind_param("s", $username);
$res=$stmt->execute();
$stmt->store_result();
$stmt->bind_result($userID); //Bind the data from database
$stmt->fetch();
$proudctid=$_POST['prodID'];

echo "<form action='booking_config.php' method='post'>
<h1 align='center'>Create your booking</h1>
<table  class='center'>
	 <tr><td>Please enter the start date in yyyy-mm-dd format</td></tr>
	<tr><td>Start Time: </td><td><input type='text' name='start_time'></td></tr>
	 <tr><td>Please enter the end date in yyyy-mm-dd format</td></tr>
    <tr><td>End Time: </td><td><input type='text' name='end_time'></td></tr>
    <tr><td><input type='hidden' value=".$userID." name='userID'/></td></tr>
    <tr><td><input type='hidden' value=".$proudctid." name='proudctid'/></td></tr>
	<tr><td></td><td><input type='submit' name='formButton' value='Submit'/></td></tr>
</table>
</form>"
?>
</div>


</body>
</html>
