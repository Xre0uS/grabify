<head>
  
<style>
<?php include 'css/bispage.css'; ?>
<?php include 'css/bistable.css'; ?>
<?php include 'css/style.css'; ?>
</style>

</head>
<body>
<h2>Bussiness Page </h2>
<h3> Fill Out the below form to add new product </h3>

<br>
<div class="container">
  <form action="bis.php">
  <div class="row">
    <div class="col-25">
      <label for="listingname">Listing Title:</label>
    </div>
    <div class="col-75">
      <input type="text" id="listingname" name="listing" placeholder="Listing Title...">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="price">Price:</label>
    </div>
    <div class="col-75">
      <input type="text" id="price" name="price" placeholder="The Price...">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="description">Description:</label>
    </div>
    <div class="col-75">
      <textarea id="description" name="description" placeholder="Basic Information about a product..." style="height:200px"></textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="myFile">Image:</label>
    </div>
    <div class="col-75">
    <input type="file" id="myFile" name="filename">
  </div>

  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </div>
  </div>
  </form>
</body>

