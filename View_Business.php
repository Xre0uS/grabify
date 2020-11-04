<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table {
  
  border: 0px solid black;
  
}
td {
  border: 0px solid black;
  text-align: left;
  padding: 2px;
  font-size:20px;
  
  
}

th {
	border: 0px solid black;
	text-align: center;
	padding: 2px;

}

.center{
margin-left:20px;
margin-right:auto;
}

a {
margin-left:20px;
font-size:20px;
}

<?php include 'css/styles.css'; ?>


</style>
</head>
<body>
<?php include 'php/navbar.php'; ?>

<button onclick="goBack()">Return</button>


<h1 style="text-align:center">Business Name</h1>
<a>Description of Business</a>
<br>
<a>Business contact info</a>
<br>
 <table border="1" class="center">
<tr><td>Products</td></tr>
	<tr>
	<td>Product Image 1</td>
    <td><a href="View_Item.php">Product Name 1</a></td>
	<td>Product Price 1</td>
	</tr>
	
	<tr>
	<td>Product Image 2</td>
    <td><a href="View_Item.php">Product Name 2</a></td>
	<td>Product Price 2</td>
	</tr>
	
	<tr>
	<td>Product Image 3</td>
    <td><a href="View_Item.php">Product Name 3</a></td>
	<td>Product Price 3</td>
	</tr>
</table>
<br>

</body>
</html>