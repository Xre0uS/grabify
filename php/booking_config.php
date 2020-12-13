<?php




include 'config.php'; //transferring the connection to another php file called config.php


//$bookingregex= "/^[a-zA-Z\d']+$/"; //regular expression for character and digits.
$startregex= "^20[0-2][0-1]-((0[1-9])|(1[0-2]))-(0[1-9]|[1-2][0-9]|3[0-1])$^"; //regular expression for numbers and dashes.
$endregex= "^20[0-2][0-1]-((0[1-9])|(1[0-2]))-(0[1-9]|[1-2][0-9]|3[0-1])$^"; //regular expression for numbers and dashes.
$userregex= "/^[0-9]+$/"; //regular expression for numbers.
$productregex= "/^[0-9]+$/"; // regular expression for numbers.




$startTime=$_POST['start_time'];
$endtime=$_POST['end_time'];
$usersID=$_POST['users_user_id'];
$product=$_POST['product_product_id'];
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
if(preg_match($productregex,$product)){ //regex checking the product input to make sure it is a valid product id.
}
else{
    echo "Please input product id ";
    die;
}

$stmt=$con->prepare("INSERT INTO booking (start_time,end_time,users_user_id,product_product_id) VALUES (?,?,?,?)"); //prepared statement
$stmt->bind_param("ssii",$startTime,$endtime, $usersID, $product); //bind the parameters that was inputted

$res=$stmt->execute(); //excute the statement together with the data
if($res){
    header( "refresh:0;url=booking.php" );
}
else{
    echo"Error";
}




?>