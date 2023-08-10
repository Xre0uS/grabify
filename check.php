<?php
include "php/lookup.php";
session_start();


require "Authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {

    TraversalLogs();
    header("location: home.php");
    die();
}
$Authenticator = new Authenticator();




$checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance

if (!$checkResult) {
    $_SESSION['failed'] = true;
    header("location: home.php");
    die();
} else {
    $_SESSION['authentication'] = "2FA";
    $_SESSION['loginstatus'] = 'true';
    echo '<script>
    sessionStorage.setItem("loginstatus", true);
    sessionStorage.setItem("user","' . $_SESSION['username'] . '");
    window.location.href = "home.php";
    </script>';
}
?>