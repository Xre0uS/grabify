<?php include 'config.php'; ?>



<?php
session_start();
if (isset($_SESSION['bloginstatus'])){
  $business_id=$_SESSION['business_id'];
}
else{
  http_response_code(403);
  die;
}
$name=$_POST['name'];
$price=$_POST['price'];
$description=$_POST['description'];
$location=$_POST['location'];

$nameregex= "/^[a-zA-Z-' \d]*$/"; //regular expression for characters and spaces.
$priceregex= "/^[0-9]+(\.[0-9]{2})?$/";
$descriptionregex= "/^[a-zA-Z-' ]*$/"; //regular expression for characters and spaces.
$locationregex= "/^[a-zA-Z-' \d]*$/"; //regular expression for characters and spaces.


if(preg_match($nameregex,$name)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    echo "Listing Title Accept Only Characters,Digits,Spaces <br>";
    die;
    }

if(preg_match($priceregex,$price)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    echo "Not Valid Price Example 1.20 or 1 <br>";
    die;
    }

if(preg_match($descriptionregex,$description)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    echo "Description Accept Only Characters and Spaces <br>";
    die;
    }

if(preg_match($locationregex,$location)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    echo "Location  accept Only Characters,numbers and Spaces <br>";
    die;
    }


$logIp = $_SERVER['REMOTE_ADDR'];
$aUname = $_SESSION['username'];
$bUname = $_SESSION['company_name'];
$logContent = "{$aUname} added product {$name} on {$bUname}";
$pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (1,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
$pQuery->bind_param('ss', $logContent, $logIp);
$pQuery->execute();

$query= $con->prepare("INSERT INTO product (name, price, description, location, business_business_id) VALUES (?,?,?,?,?);");
$query->bind_param('sdssi', $name, $price, $description, $location,$business_id);
$query->execute();
header("location:http://localhost/grabify/bis.php");




?>