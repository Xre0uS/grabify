<?php
include 'config.php';
session_start();
session_regenerate_id(); //session_regenerate_id();
?>
<?php


if(isset($_POST['Submit'])){
    $bookingID=$_POST['booking_id'];
    $product=$_POST['product_id'];
    $endtime=$_POST['end_time'];
    $startTime=$_POST['start_time'];
    $startregex= "/^(0[1-9]|[1-2][0-9]|3[0-1])+-(0[1-9]|1[0-2])+-([1-2][0-9]{3})$/";
    $endregex= "/^(0[1-9]|[1-2][0-9]|3[0-1])+-(0[1-9]|1[0-2])+-([1-2][0-9]{3})$/"; 
    if (!empty($_POST['start_time']) &&
        !empty($_POST['end_time']))
        {
        }
        else {
            echo "Error: No fields should be empty<br>";
        }

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
        
        $bquery= $con->prepare("SELECT users_user_id FROM booking WHERE booking_id=?");
        $bquery->bind_param('i', $bookingID); //bind the parameters
        $bquery->execute();
        $bquery->store_result();
        $bquery->bind_result($users_user_id);
        $bquery->fetch();
        $users_user_id= $users_user_id;
        echo $users_user_id;
        

        $query= $con->prepare("UPDATE booking set start_time=?, end_time=?, users_user_id=$users_user_id, product_product_id=? WHERE booking_id=?");
        $query->bind_param('ssii', $startTime,$endtime, $product, $bookingID); //bind the parameters
        
        if ($query->execute()){  //execute query
            header("location:http://localhost/grabify/booking.php");
        }else{
            echo $query->error;
         
    }   
}
?>