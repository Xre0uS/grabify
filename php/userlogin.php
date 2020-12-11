<?php
session_start();
include "verify.php";
include "lookup.php";
include "../mail.php";

if (isset($_POST['login'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // remove the error message showing that the user has been blocked previously
    if (isset($_SESSION['blocked'])){
        unset($_SESSION['blocked']);
    }
    if ($_POST['flag'] == '0') {

        $username = $_POST['username'];
        $passwd = $_POST['passwd'];
        if (
            !empty($username) &&
            !empty($passwd)
        ) {
            require('config.php');

            // check if the user has been blocked for multiple failed login attempts 
            $blockedByDB = checkBlock($username, $con);
            if ($blockedByDB == 1) {

                // logging in DB after blocking user in database for multiple failed login attempts 
                $ip_address = getIpAddr();
                $logContent = "Continued attempts to login using '{$username}' after being logged out in db ";
                $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (2,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
                $pQuery->bind_param('ss', $logContent, $ip_address);
                $pQuery->execute();


                $_SESSION['blocked'] = 'The account is on timeout';
                mysqli_close($con);
                header("location:../home.php");
            } else {
                $validation = auth($username, $passwd, $con);
                if ($validation) {

                    // remove all session data and regenerate a new session
                    session_unset();
                    session_regenerate_id();

                    $_SESSION['loginstatus'] = 'temp';
                    $_SESSION['username'] = $username;
                    $_SESSION['timeout'] = time();

                    $email = getEmail($username, $con);
                    newLogin($email, $username);

                    mysqli_close($con);
                    header("location:../2fa.php");
                } else {
                    $_SESSION["loginAttempts"] += 1;
                    $_SESSION['loginError'] = "Your username or password entered is incorrect";

                    // checking the number of failed attempts
                    if (isset($_SESSION['failAttempts'])) {
                        if ($_SESSION["loginAttempts"] > 2) {

                            $email = getEmail($username, $con);
                            // sending email to inform users about the failed login attempts
                            $informingUsers = infoUserMail($email, $username, 2);
                            if ($informingUsers == 1) {

                                $lockedTimeFormat = time();
                                $lockedTime = date("Y-m-d H:i:s", $lockedTimeFormat);
                                // generating the timeout time
                                $tryAgainTimeFormat = mktime(
                                    date("H"),
                                    date("i") + 2,
                                    date("s"),
                                    date("m"),
                                    date("d"),
                                    date("Y")
                                );
                                $tryAgainTime = date("Y-m-d H:i:s", $tryAgainTimeFormat);

                                $token = bin2hex(random_bytes(32));

                                $query = $con->prepare("INSERT INTO `block_user` (`username`,`block_time`, `token`, `try_time`) VALUES
                                (?,?,?,?)");

                                $query->bind_param(
                                    'ssss',
                                    $username,
                                    $lockedTime,
                                    $token,
                                    $tryAgainTime
                                ); //bind the parameters

                                if ($query->execute()) {

                                    // logging in DB after blocking user in database for multiple failed login attempts 
                                    $ip_address = getIpAddr();
                                    // log multiple failed login attempts
                                    $logContent = "Multiple failed login attempts to login to '{$username}' account";
                                    $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (2,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
                                    $pQuery->bind_param('ss', $logContent, $ip_address);
                                    $pQuery->execute();


                                    session_unset();
                                    header("location: ../home.php");
                                } else {
                                    echo "Error executing query";
                                }
                            } else {
                                echo "Error sending email";
                            }
                        }
                    }
                    mysqli_close($con);
                    header("location:../home.php");
                }
            }
        }
    }
}



if (isset($_SESSION["loginAttempts"])) {
    if ($_SESSION["loginAttempts"] > 3) {
        $_SESSION["failAttempts"] += 1;
    }
}


//check to see if timeout is $_SESSION['timeout'] is set 
if (isset($_SESSION["timeout"])) {
    $inactive = 600;
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
        session_unset();
        session_destroy();
        header("location:../home.php");
    }
}
