<?php
session_start();
session_regenerate_id(); //session_regenerate_id();

?>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<style>
<?php include 'css/styles.css'; ?>
        <?php include 'css/navbar.css'; ?>
        <?php include 'css/login.css'; ?>
  <?php include 'css/editbooking.css'; ?>
  
  
        
    </style>
    <script type="text/javascript" src="js/navbar.js"></script>
    <script type="text/javascript" src="js/userlogin.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="js/w3.js"></script>
    
    
   
</head>


<body>

 



<?php
   
include 'php/config.php';

if(isset($_SESSION["username"])){
$startregex= "/^(0[1-9]|[1-2][0-9]|3[0-1])+-(0[1-9]|1[0-2])+-([1-2][0][2][0-1])$/";
$endregex= "/^(0[1-9]|[1-2][0-9]|3[0-1])+-(0[1-9]|1[0-2])+-([1-2][0][2][0-1])$/"; 


$bookingID=$_POST['booking_id'];
$product=$_POST['product_id'];



$query="SELECT booking_id, start_time, end_time, users_user_id, product_product_id FROM booking WHERE booking_id=?";
$pQuery = $con->prepare($query);
$pQuery->bind_param('i', $bookingID); //bind the parameters
$result=$pQuery->execute();
$result=$pQuery->get_result();
    if(!$result) {
        die("Connection failed<br> ");
    }
    
    $nrows=$result->num_rows;
    
    
    if ($row=$result->fetch_assoc()) {
    }
}
?>

<form action="php/doeditbooking.php" method="post">
<h1 align='center'>Edit your booking</h1>
<table align='center'>
<tr><td>Please enter the start date in dd-mm-yyyy format</td></tr>
<tr><td>Start Time: </td><td><input type="text" name="start_time" value="<?php echo $row['start_time']?>"></td></tr>
<tr><td>Please enter the end date in dd-mm-yyyy format</td></tr>
<tr><td>End Time: </td><td><input type="text" name="end_time" value="<?php echo $row['end_time']?>"></td></tr>
<tr><td></td><td>
<input type='hidden' name='product_id' value=<?php echo $product?>>
<input type='hidden' name='booking_id' value=<?php echo $bookingID?>>
<input type="submit" name="Submit" value="Update"></td></tr>
</table>
</form>
</div>
<?php 



$con->close();

?>
</body>
</html>
