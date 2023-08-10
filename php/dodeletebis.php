<?php include 'config.php'; ?>

<?php
session_start();



if (isset($_SESSION['bloginstatus'])){
  $bloginstatus=$_SESSION['bloginstatus'];
  $business_id=$_SESSION['business_id'];
}
else{
  http_response_code(403);
  die;
}

?>
<?php



$logIp = $_SERVER['REMOTE_ADDR'];
$aUname = $_SESSION['username'];
$bUname = $_SESSION['company_name'];
$logContent = "{$aUname} deleted {$bUname} account";
$pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (1,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
$pQuery->bind_param('ss', $logContent, $logIp);
$pQuery->execute();


$asql=$con->prepare("SELECT product.product_id FROM ( product LEFT JOIN booking ON product.product_id = booking.product_product_id ) WHERE product.business_business_id=$business_id GROUP BY product.product_id
");
$aresult=$asql->execute();
$asql->store_result();
$asql->bind_result($product_id);


while($asql->fetch()){
    $fquery= $con->prepare("Delete from booking where product_product_id  = ?");
    $fquery->bind_param('i', $product_id);  
    $fquery->execute();
    $lquery= $con->prepare("Delete from favorite where product_product_id  = ?");
    $lquery->bind_param('i', $product_id);  
    $lquery->execute();



}


$rquery= $con->prepare("Delete from review where business_business_id = ?");
$rquery->bind_param('i', $business_id);  
$rquery->execute();

$dquery= $con->prepare("Delete from product where business_business_id  = ?");
$dquery->bind_param('i', $business_id); 
$dquery->execute();

$query= $con->prepare("Delete from business where business_id  = ?");
$query->bind_param('i', $business_id); 

if ($query->execute()){  //execute query
  session_destroy();
  echo "<script>
  alert('Your Account has been Deleted ');
  window.location.href='https://localhost/grabify/bislogin.php';
  </script>";
}else{
  echo "Error";
  
}
?>


    