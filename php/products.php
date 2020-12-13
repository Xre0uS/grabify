<?php include 'navbar.php'; ?>
<?php
require('config.php');
$userID = 0;
$username = $_SESSION["username"];
$stmt=$con->prepare("SELECT user_id FROM users WHERE username = ?");//Get product data from database
	$stmt->bind_param("s", $username);
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userID); //Bind the data from database

$stmt=$con->prepare("SELECT product_id, name, price, description, location, business_business_id FROM product");//Get product data from database
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($productID, $name, $price, $description, $location, $busID); //Bind the data from database
	//List the data from the database
    echo "<h1> List of products</h1>";
    echo "<table border='1'>";
    echo "<tr><td>Name</td><td>Price</td><td>Description</td><td>Location</td><td>Business ID</td><td></td>";
        while ($stmt->fetch()){
            echo "<tr><td><form action='viewproduct.php' method='post'><input type='hidden' value='".$userID."' name='userID'><input type='hidden' value='".$productID."' name='productID'><input class='viewproduct' type='submit' value='".$name."'></form></td><td>$" .$price. "</td><td>" .$description. "</td><td>" .$location. "</td><td>".$busID."</td><td><form action='favourites.php' method='post'><input type='hidden' value='".$productID."' name='prodID'> <select id='cat' name='cat'><option value='MUST-BUY'>MUST-BUY</option><option value='OPTIONAL'>OPTIONAL</option></select> <input type='submit' value='Add to Favourite'></form></td>";
    }
    echo "</table>";
?>
