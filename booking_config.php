<?php

include 'php/config.php'; //transferring the connection to another php file called config.php


$startregex= "/^(0[1-9]|[1-2][0-9]|3[0-1])+-(0[1-9]|1[0-2])+-([1-2][0-9]{3})$/";
$endregex= "/^(0[1-9]|[1-2][0-9]|3[0-1])+-(0[1-9]|1[0-2])+-([1-2][0-9]{3})$/"; 
$userregex= "/^[0-9]+$/"; //regular expression for numbers.




$startTime=$_POST['start_time'];
$endtime=$_POST['end_time'];
$usersID=$_POST['userID'];
$product=$_POST['proudctid'];


//$bookingID=$_POST['booking_id'];

if(preg_match($startregex,$startTime)){ //regex checking the name input to ensure only there are numbers and dashes present
}
else{
    echo "Please input in yyyy-mm-dd format  <br>";
    die;
}

if(preg_match($endregex,$endtime)){ //regex checking the number input to ensure only there are numbers and dashes present
}
else{
    echo "Please input in yyyy-mm-dd format <br>";
    die;
}

if(preg_match($userregex,$usersID)){ //regex checking the users input to ensure it is a valid number
}
else{
    echo "Please input the correct id <br>";
    die;
}


$stmt=$con->prepare("INSERT INTO booking (start_time,end_time,users_user_id,product_product_id) VALUES (?,?,?,?) "); //prepared statement
$stmt->bind_param("ssii",$startTime,$endtime, $usersID, $product); //bind the parameters that was inputted

$res=$stmt->execute(); //excute the statement together with the data
if($res){
    header( "refresh:0;url=booking.php" );
}
else{
    echo"Error";
}




?>
