<?php include 'config.php'; ?>

<?php
session_start();

if (isset($_SESSION['bloginstatus'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $location=$_POST['location'];
    $product_id=$_POST['product_id'];
}
else{
    http_response_code(403);
    die;
}


$nameregex= "/^[a-zA-Z-' \d]*$/"; //regular expression for characters and spaces.
$priceregex= "/^[0-9]+(\.[0-9]{2})?$/";
$descriptionregex= "/^[a-zA-Z-' ]*$/"; //regular expression for characters and spaces.
$locationregex= "/^[a-zA-Z-' \d]*$/"; //regular expression for characters and spaces.


if(preg_match($nameregex,$name)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    echo "Listing Title Accept Only Characters,Digits,Spaces <br>";
    die;
    }

if(preg_match($priceregex,$price)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    echo "Not Valid Price Example 1.20 or 1 <br>";
    die;
    }

if(preg_match($descriptionregex,$description)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    echo "Description Accept Only Characters and Spaces <br>";
    die;
    }

if(preg_match($locationregex,$location)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    echo "Location accept Only Characters, Numbers and Spaces <br>";
    die;
    }


$query= $con->prepare("UPDATE product SET name=?, price=?, description=?, location=? WHERE product_id=?");
$query->bind_param('sdssi', $name,$price, $description,$location,$product_id); //bind the parameters
if ($query->execute()){  //execute query
header("location:https://localhost/grabify/bis.php");
}else{
}
?>

