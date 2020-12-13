<?php
session_start();
session_regenerate_id(); //session_regenerate_id();
// To check if session is started.
if(isset($_SESSION["username"]))
{
    if(time()-$_SESSION["login_time_stamp"] >600)
    {
        session_unset();
        session_destroy();
        header("Location:../home.php");
    }
}
else
{
    header("Location:../home.php");
}
?>
<?php


include 'config.php'; //Getting the connection via config.php




if(isset($_GET['Submit']) && $_GET['Submit'] === "Delete"){
    $bookingID=$_GET['booking_id'];
    
    
    $query= $con->prepare("Delete from booking where booking_id = ?");
    $query->bind_param('i', $bookingID); //bind the parameters
    
    if ($query->execute()){  //execute query
        header( "refresh:0;url=booking.php" );
    }else{
        
    }
}
?>
