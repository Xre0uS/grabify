<?php include 'bisnav.php';?>

</head>

<style>
<?php include 'css/bislogin.css'; ?>
</style>
<body>
<div class="container">
<?php echo "<h1> Add Product to $company_name ?<h1>" ?>
<form action="php/dobisaddproduct.php" method="post">
      <label for="listingname" style=" font-size: 18px;">Listing Title:</label>
      <input type="text" id="listingname" name="name" placeholder="Listing Title..." required>
      <br>
      <br>
      <label for="price" style=" font-size: 18px;">Price($):</label>
      <input type="text" id="price" name="price" placeholder="The Price..." required>
      <br>
      <br>
      <label for="description" style=" font-size: 18px;">Description:</label>
      <textarea id="description" name="description" placeholder="Basic Information about a product..." style="height:200px;width:336px;" required></textarea>
      <br>
      <br>
      <label for="location" style=" font-size: 18px;">Location:</label>
      <input type="text" id="location" name="location" placeholder="Location..." required>
      <br>
      <br>
      <input style=" font-size: 18px;background-color:#66ff00;" type="submit" value="+ Add Product">
  </div>
  </form>
</body>



