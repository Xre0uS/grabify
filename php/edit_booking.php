
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


</style>
</head>
<body>

<?php include 'php/navbar.php'; ?>
<button onclick="goBack()">Return</button>


<h2 style="text-align:center">Edit Booking</h2>

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
    <td><a href="www.google.com">Delete</a></td>
    <td><a href="www.google.com">Edit</a></td>
    <tr>
    <td colspan="6" style="height:100px" >
    	<table>
    		<tr>
    			<td>Name:_____________</td>
    			</tr><tr>
    			<td>Date:_____________</td></tr>
    			<tr><td>Time:_____________</td></tr>
    			<tr><td>Reason for editing the booking:___________________________</td></tr>	
    		</tr>
    	
    	
    	</table>
    </td>
	</tr>
	<tr>
		<td>2</td>
    <td>Product Nam2</td>
    <td>12sa3cda45</td>
    <td>13Dec2020</td>
    <td>14Dec2020</td>
    <td>1pm</td>
    <td><a href="view_booking.php">View</a></td>
    <td><a href="www.google.com">Delete</a></td>
    <td><a href="www.google.com">Edit</a></td>
  
</table>

</body>
</html>

