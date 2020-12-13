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
   
include 'config.php';

if(isset($_SESSION["username"]))
{
//$bookingregex= "/^[a-zA-Z\d']+$/"; //regular expression for character and digits.
$startregex= "^20[0-2][0-1]-((0[1-9])|(1[0-2]))-(0[1-9]|[1-2][0-9]|3[0-1])$^"; //regular expression for numbers and dashes.
$endregex= "^20[0-2][0-1]-((0[1-9])|(1[0-2]))-(0[1-9]|[1-2][0-9]|3[0-1])$^"; //regular expression for numbers and dashes.
//$userregex= "/^[a-zA-Z\d\._]+@[a-zA-Z\d\.]+\.[a-zA-Z\d\.]{2,}+$/"; //regular expression for email.
//$productregex= "/^[\d]{2}+-[\d]{2}+-[\d]{4}+$/"; // regular expression for date.





if(isset($_POST['Submit'])){
    
    if (!empty($_POST['booking_id']) &&
        !empty($_POST['start_time']) &&
        !empty($_POST['end_time']) &&
        !empty($_POST['users_user_id']) &&
        !empty($_POST['product_product_id']))
       
        {
            
        }
        else {
            echo "Error: No fields should be empty<br>";
        }
        
        $startTime=$_POST['start_time'];
        $endtime=$_POST['end_time'];
        $usersID=$_POST['users_user_id'];
        $product=$_POST['product_product_id'];
        $bookingID=$_POST['booking_id'];
        
        if(preg_match($startregex,$startTime)){ //regex checking the date input to ensure yyyy-mm-dd
        }
        else{
            echo "Please enter date in yyyy-mm-dd format  <br>";
            die;
        }
        
        if(preg_match($endregex,$endtime)){ //regex checking the date input to ensure yyyy-mm-dd
        }
        else{
            echo "Please enter date in yyyy-mm-dd format";
            die;
        }
        /*
        if(preg_match($userregex,$usersID)){ //regex checking the email input to ensure it is a valid email
        }
        else{
            echo "Email is not a valid format please check ur input  <br>";
            die;
        }
        if(preg_match($productregex,$product)){ //regex checking the date input to make sure it is a valid date format.
        }
        else{
            echo "Date is not a valid format you should try (dd-mm-yyyy) please check ur input ";
            die;
        }
        */
        
        $query= $con->prepare("UPDATE booking set start_time=?, end_time=?, users_user_id=?, product_product_id=? WHERE booking_id=?");
        $query->bind_param('ssiii', $startTime,$endtime, $usersID, $product, $bookingID); //bind the parameters
        
        if ($query->execute()){  //execute query
            echo "Query executed.";
            header("location: booking.php");
        }else{
         
        }
        
}


if(isset($_GET['Submit']) && $_GET['Submit']==="GetUpdate"){
    $bookingID=$_GET['booking_id'];
    //$bookingID=basename(realpath($_GET['booking_id'])); directory traversal prevention
    
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
        ?>

<div>
    <form action="editbooking.php" method="post">
    	<h1 align='center'>Edit your booking</h1>
    	<table align='center'>
        <tr><td>Please enter the start date in yyyy-mm-dd format</td></tr>
        <tr><td>Start Time: </td><td><input type="text" name="start_time" value="<?php echo $row['start_time']?>"></td></tr>
        <tr><td>Please enter the end date in yyyy-mm-dd format</td></tr>
        <tr><td>End Time: </td><td><input type="text" name="end_time" value="<?php echo $row['end_time']?>"></td></tr>
        <tr><td>User: </td><td><input type="text" name="users_user_id" value="<?php echo $row['users_user_id']?>"></td></tr>
        <tr><td>Product:</td><td><input type="text" name="product_product_id" value="<?php echo$row['product_product_id']?>"></td></tr>
        
        <tr><td></td><td>
        <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']?>">
        <input type="submit" name="Submit" value="Update"></td></tr>
    	</table>
    </form>
    </div>
<?php 
    }
}
}
$con->close();

?>
</body>
</html>
