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

$usernameregex= "/^[a-zA-Z\d#?!@$%^&*-]{1,45}+$/";
$passwordregex= "/^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{7,}$/";
$cnameregex= "/^[a-zA-Z-' \d]*$/"; //regular expression for characters and spaces.
$contactregex= "/^[6,8,9]{1}[0-9]{7}$/"; //regular expression for digitals.
$emailregex= "/^[a-zA-Z\d\._]+@[a-zA-Z\d\.]+\.[a-zA-Z\d\.]{2,}+$/"; //regular expression for email.
$addressregex="/^[a-zA-Z-' \d]*$/";


if(isset($_POST['Register']) && $_POST['Register'] === "Register"){ //check the user input to ensure non empty. 
    $busername=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $cname=$_POST['cname'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $cnumber=$_POST['cnumber'];

    $sql=$con->prepare("SELECT username FROM business");
    $result=$sql->execute();
    $sql->store_result();
    $sql->bind_result($username);
    while($sql->fetch()){
    if($busername === $username ){
        die("Username Taken Please Choose Another One");
    }
    }

    if($password === $cpassword){        
    }else{
        die("Password do not match");
    }

    if(preg_match($usernameregex,$busername)){ 
    }else{
        die("Invalid Username");
        }

    if(preg_match($passwordregex,$passwordregex)){ 
    }else{
        echo ("Does not much the password policy;");
        die ("Minimum of 7 characters. Should have at least one special character and one number and one UpperCase Letter.");
    }

    if(preg_match($cnameregex,$cname)){
    }else{
        die("Invalid Company Name only characters,numbers and spaces ");
        }
    
    if(preg_match($emailregex,$email)){ 
    }else{
        die("Invalid Email");
        }

    if(preg_match($addressregex,$address)){ 
    }else{
        die("Not a Valid Address");
        }
        
    if(preg_match($contactregex,$cnumber)){ 
    }else{
        die("Not a Valid Singapore Contact Number ");
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query= $con->prepare("INSERT INTO business (username, password, company_name, email, address, contact_number) VALUES (?,?,?,?,?,?);");
        $query->bind_param('sssssi', $busername, $hashed_password, $cname, $email,$address,$cnumber,);
        if ($query->execute()){  //execute query
            header("location:https://localhost/grabify/biswait.php");
        }else{
            echo $query->error;
            echo "Error executing query.";
            }

}

?>
