<?php

session_start();

include "verify.php";
include "../mail.php";

// updating user information 
if (isset($_POST["update"])) {

    //unset any error messages set in the session
    if (isset($_SESSION['profileFieldEmpty'])) {
        unset($_SESSION['profileFieldEmpty']);
    }

    if (isset($_SESSION['uEmailError'])) {
        unset($_SESSION['uEmailError']);
    }

    if (isset($_SESSION['uMobileError'])) {
        unset($_SESSION['uMobileError']);
    }

    if (isset($_SESSION['uAddressError'])) {
        unset($_SESSION['uAddressError']);
    }


    $email = $_POST['email'];
    $mobile = $_POST['mobileNo'];
    $addr = $_POST['address'];


    // Allow database to be accessed 
    $accessDB = 1;

    // check for empty fields 
    if (
        !empty($email) &&
        !empty($mobile) &&
        !empty($addr)
    ) {
        echo "OK: fields are not empty<br>";
        $arr = array('mobileNo', 'email', 'address');

        $username = $_SESSION['username'];

        foreach ($arr as &$i) {
            $matchesRegex = checkField($i);
            echo $i . ' ' . $_POST[$i] . ' ' . $matchesRegex . '<br>';

            if ($matchesRegex == 0) {
                switch ($i) {

                    case 'mobileNo':
                        echo 'Invalid Phone Number.<br>';
                        $_SESSION['uMobileError'] = "Invalid Phone Number e.g. of Phone number: 8123 1234";
                        break;

                    case 'email':
                        echo 'Invalid email.<br>';
                        $_SESSION['uEmailError'] = "Invalid email.";
                        break;

                    case 'address':
                        echo 'Invalid Address.<br>';
                        $_SESSION['uAddressError'] = "Invalid Address.";
                        break;

                    default:
                        echo "<br> Error: Code Logic Error";
                        break;
                }
                $accessDB = 0;
            }
        }

        if ($accessDB == 1) {
            require_once('config.php');
            $query = $con->prepare("UPDATE `users` set email=?,mobile_number=?,address=? WHERE username=?");
            // change the variables according to the requirements and remove this comment 

            $query->bind_param('siss', $email, $mobile, $addr, $username);

            if ($query->execute()) {
                echo "Query executed.";

                // sending email to inform users that their profile has been updated 
                $informingUsers = infoUserMail($email, $username, 1);
                // if ($informingUsers == 1) {
                    echo 'hi';
                     $_SESSION['iUpdateSuccess'] = 1;
                    header("Location:../profile.php");
                // } else {
                //     echo "Error sending mail";
                // }
            } else {
                echo "Error executing query.";
            }
            $con->close();
        }
    } else {
        $_SESSION['profileFieldEmpty'] = "No fields should be left empty";
    }
    header("location:../profile.php");
}

// updating password 
if (isset($_POST['cPasswdBtn'])) {

    // Allow database to be accessed 
    $accessDB = 1;
    //unset any error messages set in the session
    if (isset($_SESSION['passwdFieldEmpty'])) {
        unset($_SESSION['passwdFieldEmpty']);
    }

    if (isset($_SESSION['wrongOldPass'])) {
        unset($_SESSION['wrongOldPass']);
    }

    if (isset($_SESSION['notMatch'])) {
        unset($_SESSION['notMatch']);
    }

    if (isset($_SESSION['samePass'])) {
        unset($_SESSION['samePass']);
    }

    // iff usersignup() runs will $_POST['flag'] obtains a value of 1 or 0 
    // where 1 = there is missing user input and an error message will be shown 
    // and 0 = there is no missing user input and data entered by the user will be assigned to the variables to be processed by PHP
    if ($_POST['flag'] == '0') {

        $oPass = $_POST['oPasswd'];
        $nPass = $_POST['passwd'];
        $cPass = $_POST['cfmpasswd'];
        $username = $_SESSION["username"];

        // echo "Original Pass: " . $oPass . "<br>";
        // echo "New Pass: " . $nPass . "<br>";
        // echo "Confirm Pass:" . $cPass . "<br>";
        // echo "Username:" . $username . "<br>";
    } else if ($_POST['flag'] == '1') {
        $_SESSION['passwdFieldEmpty'] = "Please enter all the information";
        header("location:../prorfile.php");
    }

    // check for empty fields and if the new password entered matches the confirm password field
    if (
        !empty($oPass) &&
        !empty($nPass) &&
        !empty($cPass)
    ) {

        $arr = array('passwd', 'cfmpasswd');

        foreach ($arr as &$i) {
            $matchesRegex = checkField($i);
            echo $i . ' ' . $_POST[$i] . ' ' . $matchesRegex . '<br>';

            if ($i == "passwd") {

                /** 
                 * checkField('passwd') returns an integer in the format ABCDE
                 * where A, B, C, D & E are either 1 or 0 
                 * A represents whether the password is at least 8 characters long 
                 * B represents whether the password contains at least a special character 
                 * C represents whether the password contains at least a number 
                 * D represents whether the password contains at least an uppercase letter
                 * E represents whether the password contains at least a lowercase letter 
                 * */

                if ($matchesRegex < 10000) {
                    // A is 0 
                    echo 'Length of password must be at least 8 characters long.<br>';
                }
                if (intdiv($matchesRegex, 1000) % 10 == 0) {
                    // B is 0
                    echo 'Password must contain at least a special character.<br>';
                }
                if (intdiv($matchesRegex, 100) % 10 == 0) {
                    // C is 0
                    echo 'Password must contain at least a number.<br>';
                }
                if (intdiv($matchesRegex, 10) % 10 == 0) {
                    // D is 0
                    echo 'Password must contain at least an uppercase letter.<br>';
                }
                if ($matchesRegex % 10 == 0) {
                    // E is 0 
                    echo 'Password must contain at least a lowercase letter.<br>';
                }
                if ($matchesRegex != 11111) {
                    $accessDB = 0;
                }
            } else if ($matchesRegex == 0) {
                switch ($i) {

                    case 'cfmpasswd':
                        echo 'Password Does not match';
                        $_SESSION['sPasswdNotMatch'] = "Password Does not match";
                        break;

                    default:
                        echo "<br> Error: Code Logic Error";
                        break;
                }
                $accessDB = 0;
                header("location:../profile.php");
            }
        }



        if ($accessDB == 1) {
            require_once('config.php');
            $verifyOldPass = auth($username, $oPass, $con);

            if ($verifyOldPass) {

                if ($nPass == $oPass) {
                    $_SESSION['samePass'] = "Password entered is the same as the old password";
                    header("location:../profile.php");
                } else {
                    $hashedpass = password_hash($nPass, PASSWORD_BCRYPT);
                    echo "hashed password: " . $hashedpass . "<br>";

                    $query = $con->prepare("UPDATE `users` set password=? WHERE username=?");

                    $query->bind_param('ss', $hashedpass, $username);

                    if ($query->execute()) {
                        echo "Query executed.";

                        // retrieving email address
                        $email = getEmail($username, $con);

                        // sending email to inform users that their password has been updated
                        $informingUsers = infoUserMail($email, $username, 0);
                        if ($informingUsers == 1) {
                            //echo "sucess";
                            $_SESSION['pUpdateSuccess'] = 1;
                            header("Location:../profile.php");
                        } else {
                            echo "Error sending mail";
                        }
                    } else {
                        echo "Error executing query.";
                    }
                }
            } else {
                $_SESSION['wrongOldPass'] = "Incorrect Old password";
                header("location:../profile.php");
            }
            $con->close();
        }
    } else {
        $_SESSION['passwdFieldEmpty'] = "No fields should be left empty";
        header("location:../profile.php");
    }
}
