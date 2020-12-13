<?php
require('php/config.php');
$userID = $_POST["userID"];
$reviewID = $_POST["reviewID"];
echo $reviewID;
$stmt=$con->prepare("SELECT review.rating, review.content, review.timestamp, product.name, business.company_name FROM (review LEFT JOIN product ON review.product_product_id = product.product_id) LEFT JOIN business ON review.business_business_id = business.business_id WHERE review.review_id = ?");//Get favorite data from database
    $stmt->bind_param("i", $reviewID);
	$res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($rating, $content, $timestamp, $prodName, $busName); //Bind the data from database
	//List the data from the database
    echo "<h1> Viewing reviews</h1>";
    echo "<table border='0' cellspacing='10px'>";
    echo "<tr><td>Product Name</td><td>Business Name</td><td>Rating</td><td>Content</td><td>Timestamp</td><td>Update Review</td><td>Delete Review</td>";
        while ($stmt->fetch()){
            echo "<tr><td>" .$prodName. "</td><td>".$busName."</td><td>".$rating."/5⭐</td><td>".$content."</td><td>".$timestamp."</td><td><form action='updatecomment.php' method='post'><input type='hidden' value='".$reviewID."' name='reviewID'><select id='rating' name='rating'><option value='".$rating."' selected hidden>".$rating."</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select><input type='text' value='".$content."' name='content''><input type='submit' value='Update review'></form></td><td><form action='deletecomment.php' method='post'><input type='hidden' value='".$reviewID."' name='reviewID'><input type='submit' value='Delete review'></td>";
			}
    echo "</table>";
?>

