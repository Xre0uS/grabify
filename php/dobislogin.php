<?php include 'config.php'; ?>
<?php
			
if(isset($_POST['g-recaptcha-response'])) {
	$captcha = $_POST['g-recaptcha-response'];
}

if(!$captcha || empty($captcha)) {
  echo "<script>
  alert('Captcha Error');
  window.location.href='https://localhost/grabify/bislogin.php';
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
session_start();

$ausername=$_POST['ausername'];
$epassword=$_POST['password'];
function authenticate( $ausername, $epassword)
{
    if(empty($ausername) || empty($epassword))
{
die("UserName or password is empty!");
}
}
$usernameregex= "/^[a-zA-Z\d#?!@$%^&*-]{1,45}+$/";

if(preg_match($usernameregex,$ausername)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
}else{
    die("Invalid Fields");
}

$sql=$con->prepare("SELECT * FROM business WHERE username='$ausername' ");
$result=$sql->execute();
$sql->bind_result($business_id,$username, $password,$company_name,$email,$address,$contact_number,$active);
$sql->fetch();


if ($ausername === $username){
}else{
  $logIp = $_SERVER['REMOTE_ADDR'];
  $logContent = "Somebody tried to log in with username:{$ausername} password:{$epassword}";
  $paQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (1,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
  $paQuery->bind_param('ss', $logContent, $logIp); 
  $paQuery->execute();
  echo "<script>
  alert('Your Password or Username is Incorrect');
  window.location.href='https://localhost/grabify/bislogin.php';
  </script>";
  die;
}

if (password_verify($epassword,$password)){
}else{
    $logIp = $_SERVER['REMOTE_ADDR'];
    $logContent = "Somebody tried to log in with username:{$ausername} password:{$epassword}";
    $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (1,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
    $pQuery->bind_param('ss', $logContent, $logIp); 
    $pQuery->execute();
    echo "<script>
    alert('Your Password or Username is Incorrect');
    window.location.href='https://localhost/grabify/bislogin.php';
    </script>";
  die;
}

// Register $role, $myusername and redirect to respective user page
if ($active === 1){

$_SESSION['business_id'] = $business_id;
$_SESSION['username'] = $username;
$_SESSION['company_name'] = $company_name;
$_SESSION['email'] = $email;
$_SESSION['address'] = $address;
$_SESSION['contact_number'] = $contact_number;
$_SESSION['password'] = $password;
$_SESSION["bloginstatus"] = true;
header("location:https://localhost/grabify/bis.php");
}
else{
     echo "<script>
    alert('Your Account has not been Approved ');
    window.location.href='https://localhost/grabify/bislogin.php';
    </script>";
  die;
}

?>