<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
a{
	font-size: 20px;
  
}

.image{
	font-size: 25px;
}

<?php include 'css/styles.css'; ?>



</style>
</head>
<body>
<?php include 'php/navbar.php'; ?>

<button onclick="goBack()">Return</button>


<h1 style="text-align:center">Product Name</h1>
<a class="image">Product Image</a>
<br>
<a href="View_Business.php">Business Name</a>
<br>
<a>Description</a>
<br>
<a>Location</a>

<?php include 'php/review.php'; ?>
<br>

</body>
</html>