
<?php include 'bisnav.php';?>
<?php include 'php/config.php'; ?>

</head>
<style>
<?php include 'css/bislogin.css'; ?>
</style>
<?php
if (isset($_SESSION['bloginstatus'])){
  $bloginstatus=$_SESSION['bloginstatus'];
  $product_id=$_POST['product_id'];
}
else{
  http_response_code(403);
  die;
}


$query= $con->prepare("SELECT name,price,description,location from product where product_id=$product_id");
$query->execute();
$query->store_result();
$query ->bind_result($name,$price,$description,$location);
$query->fetch();


?>


<body>
<div class="container">
<?php echo "<h1> Edit Product: $name ?</h1> " ?>
<form action="php/doeditbisproduct.php" method="post">
      <label for="listingname" style=" font-size: 18px;">Listing Title:</label>
      <input type="text" id="listingname" name="name" placeholder="Listing Title..." value="<?php echo $name ?>" required>
      <br>
      <br>
      <label for="price" style=" font-size: 18px;">Price($):</label>
      <input type="text" id="price" name="price" placeholder="The Price..." value="<?php echo $price ?>"required>
      <br>
      <br>
      <label for="description" style=" font-size: 18px;">Description:</label>
      <textarea  id="description" name="description"  style="height:200px;width:336px;text-align: left;" required><?php echo $description ?></textarea>
      <br>
      <br>
      <label for="location" style=" font-size: 18px;">Location:</label>
      <input type="text" id="location" name="location" placeholder="Location..." value="<?php echo $location ?>" required>
      <br>
      <br>
      <?php echo "<input type='hidden' name='product_id' value='" .$product_id."'>"; ?>

      <input style=" font-size: 18px;background-color:#66ff00;" type="submit" value="Edit Product">
  </div>
  </form>
</body>