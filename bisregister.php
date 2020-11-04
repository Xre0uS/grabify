<head>
  
<style>
<?php include 'css/bispage.css'; ?>
<?php include 'css/bistable.css'; ?>
<?php include 'css/style.css'; ?>
</style>

</head>
<body>
<h2>Bussiness Page </h2>
<h3> Fill out the below form to register for Grabify </h3>

<br>
<div class="container">
  <form action="biswaiting.php">
  <div class="row">
    <div class="col-25">
      <label for="bisname">Business Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="bisname" name="bisname" placeholder="Business Name...">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="username">Username:</label>
    </div>
    <div class="col-75">
      <input type="text" id="username" name="username" placeholder="Username...">
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="password">Password:</label>
    </div>
    <div class="col-75">
      <input type="text" id="password" name="password" placeholder="Password...">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="email">Email:</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="email" placeholder="Email...">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="contact">Contact Number:</label>
    </div>
    <div class="col-75">
      <input type="text" id="contact" name="contact" placeholder="Contact Number...">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="bisaddress">Business Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="bisaddress" name="bisaddress" placeholder="Business Address...">
    </div>
  </div>

  <div class="row">
    <input type="submit" value="Register">
  </div>
  </div>
  </div>
  </form>
</body>



