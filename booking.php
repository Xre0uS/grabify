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
        <?php include 'css/booking.css'; ?>

       
    </style>
    <script type="text/javascript" src="js/navbar.js"></script>
    <script type="text/javascript" src="js/userlogin.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="js/w3.js"></script>
    
</head>


<body>

 
<?php 

include 'php/config.php';




if(isset($_SESSION["username"]))
{
    $username=$_SESSION["username"];
    
    $pQuery="SELECT booking.booking_id, booking.start_time, booking.end_time, product.name, product.product_id FROM (( booking LEFT JOIN product ON booking.product_product_id = product.product_id ) LEFT JOIN users ON booking.users_user_id=users.user_id ) WHERE users.username='$username' GROUP BY booking.booking_id" ;
    $pQuery = $con->prepare($pQuery); //Prepared statement
    $result=$pQuery->execute(); //execute the prepared statement
    $result=$pQuery->get_result(); //store the result of the query from prepared statement
    if(!$result) {
        die("Connection failed<br> ");
    }
    else {
        
    }
    
    $nrows=$result->num_rows; //store the number of rows from the results
    if ($nrows>0) {
        echo "<h1 align='center'>Bookings</h1>";
        echo "<table>"; //Draw the table header
        echo "<table align='center'  width=50%>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Start Time</th>";
        echo "<th>End Time</th>";
        echo "<th>User</th>";
        echo "<th>Product</th>";
        echo "</tr>";
        while ($row=$result->fetch_assoc()) { //fields that will be filled with the details taken from sql db
            echo "<tr>";
            echo "<td>";
            echo $row['booking_id']; //defined in the db
            echo "</td>";
            echo "<td>";
            echo $row['start_time'];
            echo "</td>";
            echo "<td>";
            echo $row['end_time'];
            echo "</td>";
            echo "<td>";
            echo $username;
            echo "</td>";
            echo "<td>";
            echo $row['name'];
            echo "</td>";
            echo "<td>";
            echo "<form action='editbooking.php' method='post'>";
            echo "<input type='hidden' name='product_id' value='" .$row['product_id']."'>";
            echo "<input type='hidden' name='booking_id' value='" .$row['booking_id']."'>";
            echo "<input type='submit' value='Edit '>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<a href='deletebooking.php?Submit=Delete&booking_id=".$row['booking_id']."'><button>Delete</button></a>"; //link to deletebooking.php delete function
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }else{
        echo "no booking";
    }
    if(time()-$_SESSION["timeout"] >600)
    {
        session_unset();
        session_destroy();
        header("Location:../home.php");
    }
    }

else
{
   
}





?>


</body>
</html>