<?php include 'bisnav.php'; ?>
<?php include 'php/config.php'; ?>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
.button-container form,
.button-container form div {
    display: inline;
}

.button-container button {
    display: inline;
    vertical-align: middle;
  
}

input[type="submit"] {
  background: none;
  border: none;
  outline: none;
  text-decoration: underline;
  color: black
}
input[type="submit"]:hover {
  color: red;
}

</style>
<h1>Your Products:</h1>

<?php
$business_id=$_SESSION['business_id'];


$rquery= $con->prepare("SELECT * FROM product WHERE business_business_id=$business_id");
$result=$rquery->execute();
$rquery->store_result();
$rquery ->bind_result($product_id,$name,$price,$description,$location,$business_business_id);
if($rquery->num_rows === 0) exit("Seems to be no product found");


while($rquery->fetch()){
  echo "<div class='card'>";
  echo "<h1>$name</h1>";
  echo "<p class='price'>$$price</p>";
  echo "<p>$description</p>";
  echo "<p>Location: $location</p>";
  echo "<div class='button-container'>";
  echo "<form action='bisviewmore.php' method='post' <br>";
  echo "<div>";
  echo "<input type='hidden' name='product_id' value='" .$product_id."'>";
  echo "<input type='hidden' name='pname' value='" .$name."'>";
  echo "<input type='submit' value='View More '>";
  echo "</div>";
  echo"</form>";
  echo "<form action='biseditproduct.php' method='post'><br>";
  echo "<div>";
  echo "<input type='hidden' name='product_id' value='" .$product_id."'>";
  echo "<input type='submit' value='Edit'>";
  echo "</div>";
  echo "</form>";
  echo "<form action='php/dobisdeleteproduct.php' method='post'><br>";
  echo "<div>";
  echo "<input type='hidden' name='product_id' value='" .$product_id."'>";
  echo "<input type='submit' value='Delete'>";
  echo"</form>";  
  echo " </div>";
  echo " </div>";
  echo " </div>";
}





?>