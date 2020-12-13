<?php include 'config.php'; ?>
<?php
			
if(isset($_POST['g-recaptcha-response'])) {
	$captcha = $_POST['g-recaptcha-response'];
}

if(!$captcha || empty($captcha)) {
  echo "<script>
  alert('Captcha Error');
  window.location.href='http://localhost/grabify/bischeck.php';
  </script>";
  die;
}

$secretKey = '6LfXJQEaAAAAAB_mS3lwsEUph4L1QoRoaX5bMVsO';
$ip = $_SERVER['REMOTE_ADDR'];
$url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urlencode($secretKey).'&response='.urlencode($captcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response, true);

if($responseKeys["success"]) {
} 
else {
    echo 'Hello, robot!';
	die;
}
	?>
<?php


$rusername=$_POST['username'];
$rpassword=$_POST['password'];


$usernameregex= "/^[a-zA-Z\d#?!@$%^&*-]{1,45}+$/";

if(preg_match($usernameregex,$rusername)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    echo "Username only allows number,letters and some special characters <br>";
    die;
    }

$query=$con->prepare("SELECT active,username,password FROM business WHERE username='$rusername' ");
$query->execute();
$query->store_result();
$query->bind_result($active,$username,$password);
$query->fetch();


if (password_verify($rpassword,$password) && $rusername === $username){
}
else{
echo "<script>
alert('Username or Password May be Invalid');
window.location.href='https://localhost/grabify/bischeck.php';
</script>";
die;
}


if ($active === 1)
{
  echo "Your Business has been Approved <br>";
  echo "<a href='https://localhost/grabify/bislogin.php'>Login Now ?</a><br />";
}
else
{
  echo "Your Business is still pending Approval <br>";
  echo "<a href='https://localhost/grabify/bislogin.php'>Go Back to Login Page? </a><br />";
}
?>

