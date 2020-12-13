<?php include 'navbar.php'; ?>
<?php
session_start();
session_regenerate_id(); //regenerate new session id
require('config.php');
// To check if session is started.
if(isset($_SESSION["username"]))
{
	$username = $_SESSION["username"];
$stmt=$con->prepare("SELECT user_id FROM users WHERE username = ?");//Get product data from database
	$stmt->bind_param("s", $username);
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userID); //Bind the data from database
$userID = $userID;
$stmt=$con->prepare("SELECT product.product_id, product.name, product.price, product.description, product.location, business.company_name FROM (product LEFT JOIN business ON product.business_business_id = business.business_id) GROUP BY product.product_id");//Get product data from database
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($productID, $name, $price, $description, $location, $busName); //Bind the data from database
	//List the data from the database
    echo "<h1> List of products</h1>";
    echo "<table border='1'>";
    echo "<tr><td>Name</td><td>Price</td><td>Description</td><td>Location</td><td>Business Name</td><td></td>";
        while ($stmt->fetch()){
            echo "<tr><td><form action='viewproduct.php' method='post'><input type='hidden' value='".$userID."' name='userID'><input type='hidden' value='".$productID."' name='productID'><input class='viewproduct' type='submit' value='".$name."'></form></td><td>$" .$price. "</td><td>" .$description. "</td><td>" .$location. "</td><td>".$busName."</td><td><form action='favourites.php' method='post'><input type='hidden' value='".$productID."' name='prodID'> <select id='cat' name='cat'><option value='MUST-BUY'>MUST-BUY</option><option value='OPTIONAL'>OPTIONAL</option></select> <input type='submit' value='Add to Favourite'></form></td>";
    }
    echo "</table>";
	
    if(time()-$_SESSION["login_time_stamp"] >600)
    {
        session_unset();
        session_destroy();
        header("Location:../home.php");
    }
}
else
{
	
$stmt=$con->prepare("SELECT product.product_id, product.name, product.price, product.description, product.location, business.company_name FROM (product LEFT JOIN business ON product.business_business_id = business.business_id) GROUP BY product.product_id");//Get product data from database
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($productID, $name, $price, $description, $location, $busName); //Bind the data from database
	//List the data from the database
    echo "<h1> List of products</h1>";
    echo "<table border='1'>";
    echo "<tr><td>Name</td><td>Price</td><td>Description</td><td>Location</td><td>Business Name</td>";
        while ($stmt->fetch()){
            echo "<tr><td><form action='viewproduct.php' method='post'><input type='hidden' value='".$productID."' name='productID'><input class='viewproduct' type='submit' value='".$name."'></form></td><td>$" .$price. "</td><td>" .$description. "</td><td>" .$location. "</td><td>".$busName."</td>";
    }
    echo "</table>";
}
?>
