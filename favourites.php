<?php
require('php/config.php');

$prodID = $_POST["prodID"];
$cat = $_POST["cat"];
$userID = $_POST["userID"];

$stmt=$con->prepare("INSERT INTO favorite (category, users_user_id, product_product_id) VALUES (?,?,?)"); //Insert function
$stmt->bind_param("sii", $cat, $userID, $prodID);
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
<html>
