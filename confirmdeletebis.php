
<?php include 'bisnav.php';
?>
<style>
<?php include 'css/bislogin.css'; ?>
  .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.button2 {
  background-color: #f44336; /* red */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}

</style>
</head>
<html>
<body>


<div class="container">
    <h4>Do You Really Want to Delete</h4>
    <?php echo "<h2> $company_name  Account</h2>" ?>
    <button onclick="window.location.href='php/dodeletebis.php'" class="button">Yes</button>
    <button onclick="window.location.href='bis.php'" class="button2" >No</button>

</body>
</html>

      
