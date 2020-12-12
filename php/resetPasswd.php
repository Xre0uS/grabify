<?php
session_start();

include "verify.php";
require "../mail.php";

if (isset($_POST["resetPasswd"]) && (!empty($_POST["resetPasswdEmail"])) && (!empty($_POST["resetPasswdUsername"]))) {

    $username = $_POST['resetPasswdUsername'];
    $email = $_POST["resetPasswdEmail"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($email) {
        session_unset();
        echo "valid email";

        require_once "config.php";
        $result = checkEmail($username, $email, $con);

        if ($result === "Please verify your username or email address again.") {
            $_SESSION['userNotFound'] = $result;
        } else {
            $username = $result;
            // echo "username: " . $username . "<br>";

            $expFormat = mktime(
                date("H"),
                date("i"),
                date("s"),
                date("m"),
                date("d") + 1,
                date("Y")
            );
            $expDate = date("Y-m-d H:i:s", $expFormat);


            $token = bin2hex(random_bytes(32));

            // echo "expiry date: " . $expDate . "<br>";
            // echo "new key: " . $token . "<br>";

            $query = $con->prepare("INSERT INTO `password_reset_temp` (`email`,`csrfToken`, `exp_date`) VALUES
                (?,?,?)");

            $query->bind_param(
                'sss',
                $email,
                $token,
                $expDate
            ); //bind the parameters

            if ($query->execute()) {
                // echo "Query executed.";

                
                $result = sendMail($email, $username, $token);

                if ($result == 1) {
                    // echo "An email has been sent to you with instructions on how to reset your password. <br>";
                    $_SESSION['emailSent'] = 1;
                    header("Location: ../home.php");
                } else {
                    //echo "Error sending mail <br>";
                    $_SESSION['emailSent'] = 0;
                    header("Location: ../home.php");
                }
            } else {
                echo "Error executing query";
            }
        }
        mysqli_close($con);
    } else {
        echo "invalid email";
        $_SESSION['resetEmailError'] = 'Invalid email address. Please type a valid email address!';
        header("Location:../home.php");
    }
}

if (isset($_POST['updatePasswd'])) {
    // Allow database to be accessed 
    $accessDB = 1;

    // check for empty fields and if the new password entered matches the confirm password field
    if (
        !empty($_POST['passwd']) &&
        !empty($_POST['cfmpasswd'])
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
                        $_SESSION['rPasswdNotMatch'] = "Password Does not match";
                        break;

                    default:
                        echo "<br> Error: Code Logic Error";
                        break;
                }
                $accessDB = 0;
                header("location:../forgetpassword.php");
            }
        }

        $nPass = $_POST['passwd'];
        $cPass = $_POST['cfmpasswd'];
        $email = $_POST['email'];

        echo "New Pass: " . $nPass . "<br>";
        echo "Confirm Pass:" . $cPass . "<br>";
        echo "Email:" . $email . "<br>";

        if ($accessDB == 1) {
            require_once('config.php');


            $hashedpass = password_hash($nPass, PASSWORD_BCRYPT);

            $query = $con->prepare("UPDATE `users` set `password`=? WHERE `email`=?");

            $query->bind_param('ss', $hashedpass, $email);

            if ($query->execute()) {
                echo "Query executed.";

                // echo "Deleting data from the database. <br>";
                $query = $con->prepare("Delete FROM `password_reset_temp` WHERE email=?");

                $query->bind_param('s', $email);

                if ($query->execute()) {
                    //echo "Delete Successfully.";

                    $_SESSION['rUpdateSuccess'] = 1;
                    header("Location:../home.php");
                } else {
                    // echo "Unable to Delete.";
                    echo " <script> alert('Delete Failed'); </script>";
                }
                
            } else {
                echo "Error executing query.";
            }
            $con->close();
            header("Location:../home.php");
        }
    } else {
        $_SESSION['rpasswdFieldEmpty'] = "No fields should be left empty";
        header("location:../forgetpassword.php");
    }
}
