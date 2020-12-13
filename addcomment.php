<?php
require('php/config.php');
$userID = $_POST['userID'];
$prodID = $_POST['prodID'];
$busID = $_POST['busID'];
$rating = $_POST['rating'];
$content = $_POST['content'];

$stmt=$con->prepare("INSERT INTO review (rating, content, users_user_id, product_product_id, business_business_id) VALUES (?,?,?,?,?)"); //Insert function
$stmt->bind_param("isiii", $rating, $content, $userID, $prodID, $busID);
$res=$stmt->execute();
if($res){
	echo "INSERT SUCCESSFUL";
	header("location:products.php");
	}
else{
	echo "UNABLE TO INSERT";
	header("location:products.php");
    }
?>