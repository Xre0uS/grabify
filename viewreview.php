<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        <?php include 'css/styles.css'; ?>
    </style>
</head>

<body>

    <?php include 'php/userloginfn.php'; ?>

</body>

</html>
<?php
require('php/config.php');
// To check if session is started.
if(isset($_SESSION["username"]))
{
	$username = $_SESSION['username'];
	$stmt=$con->prepare("SELECT user_id FROM users WHERE username = ?");//Get favorite data from database
    $stmt->bind_param("s", $username);
	$res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userID); //Bind the data from database
	while ($stmt->fetch()){
            $userID = $userID;
    }

	$stmt=$con->prepare("SELECT review.review_id, review.rating, review.content, review.timestamp, product.name FROM review LEFT JOIN product ON review.product_product_id = product.product_id WHERE users_user_id = ?");//Get product data from database
	$stmt->bind_param("i", $userID);
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($reviewID, $rating, $content, $timestamp, $prodName); //Bind the data from database
	//List the data from the database
	echo "<h1>All review made by you</h1>";
    echo "<table border='1'>";
    echo "<tr><td>Product Name</td><td>Rating</td><td>Content</td><td>Timestamp</td>";
        while ($stmt->fetch()){
            echo "<tr><td>" .$prodName. "</td><td>" .$rating. "/5⭐</td><td>" .$content. "</td><td>" .$timestamp. "</td><td><form action='editcomment.php' method='post'><input type='hidden' value='".$userID."' name='userID'><input type='hidden' value='".$reviewID."' name='reviewID'><input type='submit' value='Edit Review'></form></td>";
    }		
    echo "</table><br>";
    if(time()-$_SESSION["timeout"] >600)
    {
        session_unset();
        session_destroy();
        header("Location:../home.php");
    }
}
else
{
    header("Location:../home.php");
}
?>
