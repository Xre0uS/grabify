<?php include 'config.php'; ?>

<?php
session_start();

if (isset($_SESSION['bloginstatus'])){
  $business_id=$_SESSION['business_id'];

}
else{
    http_response_code(403);
    die;
}

$passwordregex= "/^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{7,}$/";
$cnameregex= "/^[a-zA-Z-' \d]*$/"; //regular expression for characters and spaces.
$contactregex= "/^[6,8,9]{1}[0-9]{7}$/"; //regular expression for digitals.
$emailregex= "/^[a-zA-Z\d\._]+@[a-zA-Z\d\.]+\.[a-zA-Z\d\.]{2,}+$/"; //regular expression for email.
$addressregex="/^[a-zA-Z-' \d]*$/";

if(isset($_POST['Edit']) && $_POST['Edit'] === "Edit"){ //check the user input to ensure non empty. 
    $cname=$_POST['cname'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $cnumber=$_POST['cnumber'];

}

    if(preg_match($cnameregex,$cname)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
    }else{
        die("Invalid Fields ");
        }
    
    if(preg_match($emailregex,$email)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
    }else{
        die("Invalid Email ");
        }

    if(preg_match($addressregex,$address)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
    }else{
        die("Invalid Address");
        }
    if(preg_match($contactregex,$cnumber)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
    }else{
        die("Not a Valid Singapore Contact Number ");
    }
        $query= $con->prepare("UPDATE business SET company_name=?, email=?, address=?, contact_number=? WHERE business_id=?");
        $query->bind_param('sssii', $cname,$email,$address,$cnumber,$business_id); //bind the parameters
        if ($query->execute()){  //execute query
    }else{
        echo $query->error;
    }

$sql=$con->prepare("SELECT * FROM business WHERE business_id=$business_id");
$result=$sql->execute();
$sql->bind_result($business_id,$username, $password,$company_name,$email,$address,$contact_number,$active);
$sql->fetch();
session_unset();
$_SESSION['business_id'] = $business_id;
$_SESSION['company_name'] = $company_name;
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
$_SESSION['address'] = $address;
$_SESSION['contact_number'] = $contact_number;
$_SESSION["bloginstatus"] = true;

echo "<script>
alert('Edited Account Information');
window.location.href='https://localhost/grabify/bis.php';
</script>";



?>
