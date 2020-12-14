<?php include 'bisnav.php'; ?>
<?php include 'php/config.php'; ?>
<?php


$pname=$_POST['pname'];
$product_id=$_POST['product_id'];
    
$sql=$con->prepare("SELECT users.username, product.name, review.rating, review.content, review.timestamp FROM ( ( review LEFT JOIN product ON product.product_id = review.product_product_id ) LEFT JOIN users ON users.user_id = review.users_user_id ) WHERE product.product_id= $product_id GROUP BY review.review_id
");
$result=$sql->execute();
$sql->store_result();
$sql->bind_result($username,$name,$rating,$content,$timestamp);

echo "<h1>Reviews for Product:   $pname </h1> ";
if($sql->num_rows === 0) echo ("There Seems to be no Rating for this product");
while($sql->fetch()){
    echo "<div class='container'>";
    echo "<p>User:$username</p>";
    echo "<p>Review:$content</p>";
    echo "<p>Rating:$rating/5⭐</p>";
    echo "<p>Posted on:$timestamp</p>";
    echo "</div>";
    echo "<hr>";
}


$asql=$con->prepare("SELECT users.username, users.mobile_number, booking.start_time, booking.end_time FROM ( ( booking LEFT JOIN product ON product.product_id = booking.product_product_id ) LEFT JOIN users ON users.user_id = booking.users_user_id ) WHERE product.product_id=$product_id GROUP BY booking.booking_id
");
$aresult=$asql->execute();
$asql->store_result();
$asql->bind_result($username,$mobile_number,$start_time,$end_time);
echo "<h1>Booking for Product:   $pname  </h1> ";
if($asql->num_rows === 0) echo("There Seems to be no Booking for this product");

while($asql->fetch()){
    echo "<div class='container'>";
    echo "<p>User:$username</p>";
    echo "<p>Start Booking Time:$start_time</p>";
    echo "<p>End Booking Time:$end_time</p>";
    echo "<p>Contact Information:$mobile_number</p>";
    echo "</div>";
    echo "<hr>";
}


    
?>