<?php include 'config.php'; ?>
<?php
session_start();

if (isset($_SESSION['bloginstatus'])){
  $product_id=$_POST['product_id'];
}
else{
  http_response_code(403);
  die;
}


$bquery= $con->prepare("Delete from booking where product_product_id = ?");
$bquery->bind_param('i', $product_id); 
$bquery->execute();

$rquery= $con->prepare("Delete from review where product_product_id = ?");
$rquery->bind_param('i', $product_id);  
$rquery->execute();

$query= $con->prepare("Delete from product where product_id = ?");
$query->bind_param('i', $product_id); 

if ($query->execute()){  //execute query
    header("location:http://localhost/grabify/bis.php");
}else{
    echo $query->error;
    }


?>