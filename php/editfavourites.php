<?php include 'navbar.php'; ?>
<?php
require('config.php');
$userID = $_POST["userID"];
$favID = $_POST["favID"];
$stmt=$con->prepare("SELECT favorite.category, product.name FROM favorite LEFT JOIN product ON favorite.product_product_id = product.product_id WHERE favorite.fav_id = ?");//Get favorite data from database
    $stmt->bind_param("s", $favID);
	$res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($cat, $productName); //Bind the data from database
	//List the data from the database
    echo "<h1> Editing favourite product</h1>";
    echo "<table border='0' cellspacing='10px'>";
    echo "<tr><td>Product Name</td><td>Favourite Category</td>";
        while ($stmt->fetch()){
            echo "<tr><td>" .$productName. "</td><td><form action='updatefavourites.php' method='post'><input type='hidden' value='".$favID."' name='favID'> <select id='cat' name='cat'><option value='".$cat."' selected hidden>".$cat."</option><option value='MUST-BUY'>MUST-BUY</option><option value='OPTIONAL'>OPTIONAL</option></select><input type='submit' value='UPDATE'></form></td><td><form action='deletefavourites.php' method='post'><input type='hidden' value='".$favID."' name='favID'><input type='submit' value='DELETE'></td>";
			}
    echo "</table>";
?>

