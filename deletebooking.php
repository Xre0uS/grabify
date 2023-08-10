<?php
session_start();
session_regenerate_id(); //session_regenerate_id();

?>
<?php


include 'php/config.php'; //Getting the connection via config.php


if(isset($_SESSION["username"]))
{
    if(isset($_GET['Submit']) && $_GET['Submit'] === "Delete"){
        $bookingID=$_GET['booking_id'];
        
        
        $query= $con->prepare("Delete from booking where booking_id = ?");
        $query->bind_param('i', $bookingID); //bind the parameters
        
        if ($query->execute()){  //execute query
            header( "refresh:0;url=booking.php" );
}
else
{

}

    }

}
?>