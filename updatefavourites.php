<?php
require('php/config.php');
$favID = $_POST["favID"];
$cat = $_POST["cat"];
$stmt=$con->prepare("UPDATE favorite SET category=? WHERE fav_id=?"); //Update function
$stmt->bind_param("ss", $cat, $favID);
$res=$stmt->execute();
if($res){
    echo "UPDATE SUCCESSFUL";
	header("location:favouritespage.php");
	}
else{
    echo "UNABLE TO UPDATE";
	header("location:favouritespage.php");
    }
?>
