<?php
require('php/config.php');
$reviewID = $_POST["reviewID"];
$stmt=$con->prepare("Delete FROM review WHERE review_id=?"); //Delete function
$stmt->bind_param("i", $reviewID);
$res=$stmt->execute();
if($res){
    echo "DELETE SUCCESSFUL";
	header("location:viewreview.php");
}
else{
    echo "UNABLE TO DELETE";
	header("location:viewreview.php");
}
?>