
<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table {
  
  border: 1px solid black;
  
}
td {
  border: 1px solid black;
  text-align: left;
  padding: 2px;
  
  
}

th {
	border: 1px solid black;
	text-align: center;
	padding: 2px;

}

.center{
margin-left:auto;
margin-right:auto;
}

<?php include 'css/styles.css'; ?>

//color:var():

</style>
</head>
<body>

<?php include 'php/navbar.php'; ?>
<button onclick="goBack()">Return</button>





<h2 style="text-align:center">Delete Bookings</h2>

<table border="1" class="center">
  <tr>
    <th>ID</th>
    <th>Booking Name</th>
    <th>Booking ID</th>
    <th>Booking Start</th>
    <th>Booking End</th>
    <th>Timing</th>
  </tr>
  <tr>
  	<td>1</td>
    <td>Product Name</td>
    <td>12sa3cda45</td>
    <td>13Dec2020</td>
    <td>14Dec2020</td>
    <td>1pm</td>
    <td><a href="View_Booking.php">View</a></td>
    <td><a href="Delete_Booking.php" onclick=alert("Delete")>Delete</a></td>
    <td><a href="Edit_Booking.php">Edit</a></td>
    </tr>

  
</table>

</body>
</html>

