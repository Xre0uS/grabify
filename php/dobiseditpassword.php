<?php include 'config.php'; ?>

<?php
session_start();
if (isset($_SESSION['bloginstatus'])){
    $business_id=$_SESSION['business_id'];
    $passwordregex= "/^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{7,}$/";
    $oldpassword=$_POST['oldpassword'];
    $newpassword=$_POST['newpassword'];
  }
  else{
    http_response_code(403);
    die;
  }

  $sql=$con->prepare("SELECT password FROM business WHERE business_id=$business_id");
  $result=$sql->execute();
  $sql->store_result();
  $sql->bind_result($password);
  $sql->fetch();

  if (password_verify($oldpassword,$password)){

    if(preg_match($passwordregex,$passwordregex)){ //regex checking the id input to ensure only there are lower and upper case from a-z is allowed and digits are allowed
    }else{
        echo ("Does not much the password policy;");
        die ("Minimum of 7 characters. Should have at least one special character and one number and one UpperCase Letter.");
    }

  $anewpassword = password_hash($newpassword, PASSWORD_DEFAULT);

  $query= $con->prepare("UPDATE business SET password=? WHERE business_id=?");
  $query->bind_param('si', $anewpassword,$business_id);
  $query->execute();
  }
  else{
    die("Password did not match the old password");
  }
  echo "<script>
alert('Updated Password');
window.location.href='https://localhost/grabify/bis.php';
</script>";


?>
