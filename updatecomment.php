<?php
require('php/config.php');
$reviewID = $_POST["reviewID"];
$rating = $_POST["rating"];
$content = $_POST["content"];

$ratingpattern = "/^[a-zA-Z0-9\s]*$/";
	if (!preg_match($ratingpattern, $rating)){
    $content = preg_replace('/[^1-5]/', '5', $rating);} 
	
$contentpattern = "/^[a-zA-Z0-9\s]*$/";
	if (!preg_match($contentpattern, $content)){
    $content = preg_replace('/[^A-Za-z0-9\-\s\.\,]/', '', $content);} 
$stmt=$con->prepare("UPDATE review SET rating=?, content=? WHERE review_id=?"); //Update function
$stmt->bind_param("iss", $rating, $content, $reviewID);
$res=$stmt->execute();
if($res){
    echo "UPDATE SUCCESSFUL";
	header("location:viewreview.php");
	}
else{
    echo "UNABLE TO UPDATE";
	header("location:viewreview.php");
    }
?>
