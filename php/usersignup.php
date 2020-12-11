<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 

include "verify.php";

if (isset($_POST['signUp'])) {
    // Allow database to be accessed 
    $accessDB = 1;

    echo "Flag is " . $_POST['flag'];

    // iff usersignup() runs will $_POST['flag'] obtains a value of 1 or 0 
    // where 1 = there is missing user input and an error message will be shown 
    // and 0 = there is no missing user input and data entered by the user will be assigned to the variables to be processed by PHP
    if ($_POST['flag'] == '0') {

        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobileNo'];
        $addr = $_POST['address'];
        $pass = $_POST['passwd'];
        $cfmpass = $_POST["cfmpasswd"];

        echo "username: " . $username . "<br>";
        echo "email: " . $email . "<br>";
        echo "mobileNo: " . $mobile . "<br>";
        echo "name: " . $name . "<br>";
        echo "pass: " . $pass . "<br>";
        echo "cfm pass: " . $cfmpass . "<br>";
    } 
    
    else if ($_POST['flag'] == '1') {                
        $_SESSION['sNoInput'] = "Please enter all the information";
        header("location:../home.php");
    }

    /**
     * Ensure that no fields are left empty and the fields are vaildated. 
     * 
     * @return String Error messages will be displayed if user input does not match the pattern specify in Regex
     */

    if (
        !empty($username) &&
        !empty($name) &&
        !empty($mobile) &&
        !empty($email) &&
        !empty($addr) &&
        !empty($pass) &&
        !empty($cfmpass)
    ) {
        echo "OK: fields are not empty<br>";
        $arr = array('username', 'name', 'mobileNo', 'email', 'address', 'passwd', 'cfmpasswd');

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
                    case 'username':
                        echo  'Username should only contain alphanumeric characters.<br>';        
                        $_SESSION['sUsernameError'] = "Username should only contain alphanumeric characters";
                        break;

                    case 'name':
                        echo 'Name should only contain alphabets.<br>';
                        $_SESSION['sNameError'] = "Name should only contain alphabets.";
                        break;

                    case 'mobileNo':
                        echo 'Invalid Phone Number.<br>';
                        $_SESSION['sMobileError'] = "Invalid Phone Number e.g. of Phone number: 8123 1234";
                        break;

                    case 'email':
                        echo 'Invalid email.<br>';
                        $_SESSION['sEmailError'] = "Invalid email.";
                        break;

                    case 'address':
                        echo 'Invalid Address.<br>';
                        $_SESSION['sAddressError'] = "Invalid Address.";
                        break;

                    case 'cfmpasswd':
                        echo 'Password Does not match';
                        $_SESSION['sPasswdNotMatch'] = "Password Does not match";
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

            // checking if the username exist in the database
            // if username exist in the database, it will return an error message
            // else it will proceed to add the data into the database 
            $usernameExist = checkUsername($username, $con);
            if ($usernameExist == 1) {
                $_SESSION['sUsernameTaken'] = "Username has been taken";
            } else if ($usernameExist == 0) {
                $hashedpass = password_hash($pass, PASSWORD_BCRYPT);
                echo "hashed password: " . $hashedpass . "<br>";

                $token = bin2hex(random_bytes(32));
                echo "token: " . $token . "<br>";

                session_unset();
                session_regenerate_id();

                $query = $con->prepare("INSERT INTO `temp_user` (`username`,`password`, `name`,`email`, `mobile_number`,`address`,`token`) VALUES
                (?,?,?,?,?,?,?)");

                $query->bind_param(
                    'ssssiss',
                    $username,
                    $hashedpass,
                    $name,
                    $email,
                    $mobile,
                    $addr,
                    $token
                ); //bind the parameters

                if ($query->execute()) {
                    echo "Query executed.";
                    
                    require "../mail.php";
                    $result = activateAccountMail($email, $username, $token);
                    $_SESSION["signUpSuccess"] = 1;
                } else {
                    echo "Error executing query";
                }
            }
            mysqli_close($con);
        }
    } else {
        echo "Error: No fields should be empty<br>";
        $_SESSION['sNoInput'] = "Please enter all the information";
    }
    header("Location: ../home.php");
}
?>