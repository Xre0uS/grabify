<?php
require('php/config.php');
$favID = $_POST["favID"];
$stmt=$con->prepare("Delete FROM favorite WHERE fav_id=?"); //Delete function
$stmt->bind_param("s", $favID);
$res=$stmt->execute();
if($res){
    echo "DELETE SUCCESSFUL";
	header("location:favouritespage.php");
}
else{
    echo "UNABLE TO DELETE";
	header("location:favouritespage.php");
}
?>
