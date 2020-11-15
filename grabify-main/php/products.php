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

.product_image{
	font-size:25px;
}
<?php include 'css/styles.css'; ?>

//color:var():

</style>
</head>
<body>
<?php include 'php/navbar.php'; ?>

<button onclick="goBack()">Return</button>


<h1 style="text-align:center">Products</h1>

 <table border="1" class="center">
  <tr>
	<td><a href="View_Item.php"><img src="" alt="Product Image 1" class="product_image"></a></td>
    <td><a href="View_Item.php">Product Name 1</a></td>
    <td><a href="View_Business.php">Business Name</a></td>
	<td>Product Price 1</td>
    </tr>
</table>
<br>

 <table border="1" class="center">
  <tr>
	<td><a href="View_Item.php"><img src="" alt="Product Image 2" class="product_image"></a></td>
    <td><a href="View_Item.php">Product Name 2</a></td>
    <td><a href="View_Business.php">Business Name</a></td>
	<td>Product Price 2</td>
    </tr>
</table>
<br>

 <table border="1" class="center">
  <tr>
	<td><a href="View_Item.php"><img src="" alt="Product Image 3" class="product_image"></a></td>
    <td><a href="View_Item.php">Product Name 3</a></td>
    <td><a href="View_Business.php">Business Name</a></td>
	<td>Product Price 3</td>
    </tr>
</table>
<br>

 <table border="1" class="center">
  <tr>
	<td><a href="View_Item.php"><img src="" alt="Product Image 4" class="product_image"></a></td>
    <td><a href="View_Item.php">Product Name 4</a></td>
    <td><a href="View_Business.php">Business Name</a></td>
	<td>Product Price 4</td>
    </tr>
</table>
<br>

</body>
</html>