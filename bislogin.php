<head>

  <style>
    <?php include 'css/bispage.css'; ?><?php include 'css/bistable.css'; ?><?php include 'css/style.css'; ?>
  </style>

</head>

<body>

  <h2>Business Login to Grabify </h2>
  <a href="bisregister.php"><input style="float:right" type="submit" value="Register"></a>
  <br>
  <div class="container">
    <form action="bis.php">
      <div class="row">
        <div class="col-25">
          <label for="username">User Name</label>
        </div>
        <div class="col-75">
          <input type="text" id="username" name="username" placeholder="User Name...">
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
        <input type="submit" value="Login">
      </div>
  </div>
  </div>
  </form>
  
</body>
