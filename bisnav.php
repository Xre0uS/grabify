<?php
session_start();
session_regenerate_id();
$inactive = 1800;
if( !isset($_SESSION['timeout']) )
$_SESSION['timeout'] = time() + $inactive; 

$session_life = time() - $_SESSION['timeout'];

if($session_life > $inactive){
 session_destroy();
 session_unset(); 
  header("location:https://localhost/grabify/bislogin.php");
     }

$_SESSION['timeout']=time();



if (isset($_SESSION['bloginstatus'])){
  $bloginstatus=$_SESSION['bloginstatus'];
  $company_name=$_SESSION['company_name'];
}
else{
  http_response_code(403);
  die;
  
}

// check to see if $_SESSION["timeout"] is set
if (isset($_SESSION["timeout"])) {
// calculate the session's "time to live"
$sessionTTL = time() - $_SESSION["timeout"];
if ($sessionTTL > $inactive) {
session_unset();
}
}
?>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
  background-color: #111;
}

h5 {
  font-size:15px;
  padding:0px;
}
</style>
</head>

<body>

<ul>
  <li><a href="bis.php"><?php echo " Grabify Business Page For $company_name "?></a></li>
  <li style="float:right"><a href="bislogout.php">Log Out</a></li>
  <li style="float:right"><a href="bisedit.php">Edit Profile</a></li>
  <li style="float:right"><a href="bisaddproduct.php">Add Product</a></li>
  <li style="float:right"><a href="bis.php">View Product</a></li>


</ul>
