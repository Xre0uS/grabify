<?php include 'userloginfn.php'; ?>
<?php

require('config.php');
// To check if session is started.
if(isset($_SESSION["username"]))
{
	$productID = $_POST['productID'];
	$userID = $_POST['userID'];
	$stmt=$con->prepare("SELECT product.name, product.price, product.description, product.location, business.business_id, business.company_name FROM product LEFT JOIN business ON product.business_business_id = business.business_id WHERE product.product_id = ?");//Get product data from database
	$stmt->bind_param("i", $productID);
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name, $price, $description, $location, $busID, $busName); //Bind the data from database
	//List the data from the database
    echo "<table border='1'>";
    echo "<tr><td>Name</td><td>Price</td><td>Description</td><td>Location</td><td>Business ID</td><td>Favourite</td>";
        while ($stmt->fetch()){
			$busID = $busID;
			echo "<h1>Viewing ".$name."</h1>";
            echo "<tr><td>" .$name. "</td><td>$" .$price. "</td><td>" .$description. "</td><td>" .$location. "</td><td>".$busName."</td><td><form action='favourites.php' method='post'><input type='hidden' value='".$productID."' name='prodID'><input type='hidden' value='".$userID."' name='userID'> <select id='cat' name='cat'><option value='MUST-BUY'>MUST-BUY</option><option value='OPTIONAL'>OPTIONAL</option></select> <input type='submit' value='Add to Favourite'></form></td>";
    }		
    echo "</table><br>";
	
	$stmt=$con->prepare("SELECT review.rating, review.content, review.timestamp, users.username FROM review LEFT JOIN users ON review.users_user_id  = users.user_id WHERE product_product_id = ?");//Get product data from database
	$stmt->bind_param("i", $productID);
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($rating, $content, $timestamp, $username); //Bind the data from database
	//List the data from the database
	echo "<h1>Comments</h1>";
    echo "<table border='1'>";
    echo "<tr><td>Username</td><td>Rating</td><td>Content</td><td>Time posted</td>";
        while ($stmt->fetch()){
            echo "<tr><td>" .$username. "</td><td>" .$rating. "/5⭐</td><td>" .$content. "</td><td>".$timestamp."</td>";
	}		
    echo "</table>";

	echo"<h2>Leave a comment on the product</h2>";
	echo"<form action='submitcomment.php' id='cform' method='POST'>
	<input type='hidden' value='".$productID."' name='prodID'>
	<input type='hidden' value='".$busID."' name='busID'>
	<select id='rating' name='rating'>
		<option value='1'>1</option>
		<option value='2'>2</option>
		<option value='3'>3</option>
		<option value='4'>4</option>
		<option value='5'>5</option>
	</select>
	<p><textarea rows='4' cols='50' name='content' form='cform' placeholder='Enter text here... (NOTE: SPECIAL CHARACTERS WILL AUTOMATICALLY BE REMOVED)'></textarea></p>
	<p><input type='submit' name='submit' value='Submit Comment'></p>
	</form>";
    if(time()-$_SESSION["login_time_stamp"] >600)
    {
        session_unset();
        session_destroy();
        header("Location:../home.php");
    }
}
else
{
    $productID = $_POST['productID'];
	$stmt=$con->prepare("SELECT product.name, product.price, product.description, product.location, business.business_id, business.company_name FROM product LEFT JOIN business ON product.business_business_id = business.business_id WHERE product.product_id = ?");//Get product data from database
	$stmt->bind_param("i", $productID);
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name, $price, $description, $location, $busID, $busName); //Bind the data from database
	//List the data from the database
    echo "<table border='1'>";
    echo "<tr><td>Name</td><td>Price</td><td>Description</td><td>Location</td><td>Business ID</td>";
        while ($stmt->fetch()){
			$busID = $busID;
			echo "<h1>Viewing ".$name."</h1>";
            echo "<tr><td>" .$name. "</td><td>$" .$price. "</td><td>" .$description. "</td><td>" .$location. "</td><td>".$busName."</td>";
    }		
    echo "</table><br>";
	
	$stmt=$con->prepare("SELECT review.rating, review.content, review.timestamp, users.username FROM review LEFT JOIN users ON review.users_user_id  = users.user_id WHERE product_product_id = ?");//Get product data from database
	$stmt->bind_param("i", $productID);
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($rating, $content, $timestamp, $username); //Bind the data from database
	//List the data from the database
	echo "<h1>Comments</h1>";
    echo "<table border='1'>";
    echo "<tr><td>Username</td><td>Rating</td><td>Content</td><td>Time posted</td>";
        while ($stmt->fetch()){
            echo "<tr><td>" .$username. "</td><td>" .$rating. "/5⭐</td><td>" .$content. "</td><td>".$timestamp."</td>";
	}		
    echo "</table>";

}
?>
