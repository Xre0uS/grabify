<?php include 'navbar.php'; ?>
<?php
require('config.php');
$userID = 2;
$stmt=$con->prepare("SELECT favorite.fav_id, favorite.category, product.name, product.price, product.description, product.location, business.company_name FROM (favorite LEFT JOIN product ON favorite.product_product_id = product.product_id) RIGHT JOIN business ON business.business_id = product.business_business_id WHERE favorite.users_user_id = ?");//Get favorite data from database
    $stmt->bind_param("s", $userID);
	$res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($favID, $cat, $productName, $productPrice, $productDes, $productLoc, $busName); //Bind the data from database
	//List the data from the database
    echo "<h1> Favourite products</h1>";
    echo "<table border='0' cellspacing='7px'>";
    echo "<tr><td>Product Name</td><td>Product Price</td><td>Product Description</td><td>Product Location</td><td>Business Name</td><td>Favourite Category</td>";
        while ($stmt->fetch()){
            echo "<tr><td>" .$productName. "</td><td>" .$productPrice. "</td><td>".$productDes."</td><td>".$productLoc."</td><td>".$busName."</td><td>".$cat."<form action='editfavourites.php' method='post'><input type='hidden' value='".$userID."' name='userID'><input type='hidden' value='".$favID."' name='favID'></td><td><input type='submit' value='Edit favourite'></form></td>";
    }
    echo "</table>";
?>