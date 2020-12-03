<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        <?php include 'css/login.css'; ?>
    </style>
    <script type="text/javascript" src="js/userlogin.js"></script>
</head>

<body>

    <div id="loginContainer" class="loginContainer">
        <div id="loginbtncontainer" class="loginbtncontainer" style="display: block;" onclick="shloginmodel()">
            <button id="login-btn" class="login-btn">
                <div class="login-txt">
                    LOGIN
                </div>
            </button>
        </div>

        <div id="loginModalContainer" class="loginModalContainer" style="display: none;">
            <div id="login-modal" class="login-modal animate">
                <form action="php/login.php" method="post" class="login">
                    <h1>LOGIN</h1>
                    <div class="space"></div>
                    <hr />
                    <div class="space"></div>
                    <input type="text" id="usernamebox" name="username" placeholder="Username" required>
                    <input type="password" id="passwordbox" name="passwd" placeholder="Password" required>
                    <input type="checkbox" class="usercheckbox" id="usercheckbox" name="rmbMe">
                    <label for="usercheckbox" class="staylogged">Stay logged in</label>
                    <div class="bigspace"></div>
                    <div class="bigspace"></div>
                    <input type="submit" name="login" value="LOGIN">
                </form>

                <div>
                    <a id="forgotpsw" class="psw">Forgot
                        password?</a>
                    <div class="space"></div>
                    <p class="signup">New user?<a class="signuplink" onclick="shloginmodel(), shsignupmodal()">
                            Sign up here.</a>
                </div>
            </div>
        </div>
    </div>

    <div>
        <a id="forgotpsw" class="psw">Forgot
            password?</a>
        <div class="space"></div>
        <p class="signup">New user?<a class="signuplink" onclick="shloginmodel(), shsignupmodal()">
                Sign up here.</a>
    </div>
    </div>
    </div>



    <div id="userbtncontainer" class="userbtncontainer" style="display: none;">
        <div class="btncontainer">
            <div class="userbtn">
                <div id="usergreet" class="userwelcome"></div>
            </div>
        </div>
        <div class="userdropdown">
            <a href="profile.php">Profile</a>
            <a href="listReview.php">My reviews</a>
            <a href="favourites.php">Favourites</a>
            <a href="#" onclick="logout()">Logout</a>
        </div>
    </div>

    <div id="passwdResetModel" class="fpswmodal animate" style="display: none;">
        <form class="fpsemail">
            <div class="modalHeader">Enter your username to reset password</div>
            <div class="space"></div>
            <hr />
            <div class="space"></div>
            <input type="text" name="" placeholder="Username">
            <div id="resetinfotext" class="warningtext" style="display: none;">No user found</div>
            <input id="resetpwname" type="button" name="" value="SUBMIT" onclick="staticReload()">
        </form>
    </div>

    <div id="userSignupContainer" class="userSignupContainer" style="display: none;">
        <div id="signupmodal" class="signupmodal animate">
            <form action="#" method="post" class="signup">
                <h1>SIGN UP</h1>
                <div class="space"></div>
                <hr />
                <div class="space"></div>

                <input id="usernamesignupbox" type="text" name="username" placeholder="Username" required>
                <input id="namesignupbox" type="text" name="name" placeholder="Name" required>
                <input id="mobilenosignupbox" type="text" name="mobileNo" placeholder="Mobile Number" required>
                <input id="emailsignupbox" type="email" name="email" placeholder="Email" required>
                <input id="addrsignupbox" type="text" name="address" placeholder="Address e.g. 123 Pine St" required>
                <input id="tpwsignupbox" type="password" name="passwd" placeholder="Password" required>
                <input id="pwsignupbox" type="password" name="cfmpasswd" placeholder="Confirm password" required>
                <ul>
                    <li>Password must be at least 8 characters long</li>
                    <li>Password must contain at least 1 special character</li>
                    <li>Password must contain at least a number</li>
                    <li>Password must contain at least an uppercase and a lowercase letter</li>
                </ul>
                <div class="space"></div>
                <div id="warninginfotext" class="warningtext" style="display: none;">Please enter all the information</div>
                <div id="warningpwtext" class="warningtext" style="display: none;">Passwords do not match</div>
                <div id="warningusernametext" class="warningtext" style="display: none;">This username is already taken</div>
                <input type="submit" name="signUp" value="SUBMIT" on>
            </form>
        </div>
    </div>

    <div id="confirmmodal" class="confirmmodal animate" style="display: none;">
        <form class="confirmtxt">
            <h1>Sign up success</h1>
            <div class="space"></div>
            <hr />
            <div class="bigspace"></div>
            <input type="button" name="" value="OK" onclick="location.reload();">
        </form>
    </div>

    <div id="resetconfirmmodal" class="confirmmodal animate" style="display: none;">
        <form class="confirmtxt">
            <h1 id="resettext"></h1>
            <div class="space"></div>
            <hr />
            <div class="bigspace"></div>
            <input type="button" name="" value="OK" onclick="location.reload();">
        </form>
    </div>

</body>

<script>
    window.onload = checkLoggedin();
</script>

<?php

/**
 * Regex is used validate each fields to ensure that the information entered by the user is indeed 
 * what it is meant to be 
 *
 * @param String $field retriving the name of the field and validate it against user input
 * 
 * @return Boolean If the user input fits the regex pattern, it will return 1 else, it will return 0.
 * @return integer An integer will be returned after password vaildation 
 * @return integer -1 will be returned if there is an error in the code 
 */

function checkField(String $field)
{
    switch ($field) {
        case 'username':
            return (preg_match('/^[a-zA-Z0-9]+/', $_POST['username']));
            break;
        case 'name':
            return (preg_match('/^[a-zA-Z\s]+/', $_POST['name']));
            break;
        case 'mobileNo':
            return (preg_match('/^[89][0-9]{7}$/', $_POST['mobileNo']));
            break;
        case 'email':
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                return 1;
                break;
            } else {
                return 0;
                break;
            }
            break;
        case 'address':
            return (preg_match('/^\d+\s[A-Za-z]+\s[A-Za-z]+/', $_POST['address']));
            break;
        case 'passwd':
            return (preg_match('/^[!@#$%&0-9A-Za-z]{8,}$/', $_POST['passwd']) * 10000 +
                preg_match('/^.*[!@#$%&].*$/', $_POST['passwd']) * 1000 +
                preg_match('/^.*[0-9].*$/', $_POST['passwd']) * 100 +
                preg_match('/^.*[A-Z].*$/', $_POST['passwd']) * 10 +
                preg_match('/^.*[a-z].*$/', $_POST['passwd']));
            break;
        case 'cfmpasswd':
            return ($_POST['passwd'] === $_POST['cfmpasswd']);

            break;
        default:
            return -1;
            break;
    }
}

function auth($username, $passwd)
{
}



if (isset($_POST['login'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $username = $_POST['username'];
    $passwd = password_hash($_POST['passwd'], PASSWORD_BCRYPT);
    echo $passwd;
    require('php/config.php');
    $query = "SELECT id, username, name, password, email FROM users
    WHERE username='$username'
    AND password='$passwd'";
    $result = mysqli_query($con, $query);
    if (!$result) {
        printerror("Querying $db_database", $con);
        echo "Username or Password is incorrect. <br>";
        die();
    } else {
        printok($query);
        session_regenerate_id();
        $_SESSION['user'] = $_POST['username'];
        header("Location: index.php");
    }
}

if (isset($_POST['logout'])) {
    session_start();
    unset($_SESSION['user']);
    session_destroy();
    header("Location: loginform.html");
}

/**
 * Processing the information and write user information into the database after verifying the user input  
 * 
 * @param Boolean $_POST['signUp] If the variable exist, TRUE will be returned and thus running the code in the IF statement 
 * 
 * @return String Error messages will be displayed if user input does not match the pattern specify in Regex
 */

if (isset($_POST['signUp'])) {

    $arr = array('username', 'name', 'mobileNo', 'email', 'address', 'passwd', 'cfmpasswd');
    $leng = count($arr);

    $results = array();

    for ($i = 0; $i <= $leng; $i++) {
        $input = $_POST[$arr[$i]];
        if ($i == 0 || $i == 1) {
            $input = filter_var($input, FILTER_SANITIZE_STRING);
            echo $input;
        }
        //remove most of the special characters
        $blacklist = array(" ", "&", "|", "%", "^", "~", "`", "<", ">", ",", "\\", "/", "script");
        $input = strip_tags($input);
        //str_replace($blacklist, "", $input);


        echo $input . '<br>';
        $results[$i] = $input;
    }

    echo $results[6];
    // setting variables to extract user inputs 
    $username = $results[0];
    $name = $results[1];
    $email = $results[2];
    $mobile = $results[3];
    $addr = $results[4];
    $pass = $results[5];
    $cfmpass = $results[6];


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

            switch ($i) {
                case 'username':
                    if ($matchesRegex == 0) {
                        echo  'Username should only contain alphanumeric characters.<br>';
                    }
                    break;
                case 'name':
                    if ($matchesRegex == 0) {
                        echo 'Name should only contain alphabets.<br>';
                    }
                    break;
                case 'mobileNo':
                    if ($matchesRegex == 0) {
                        echo 'Invalid Phone Number.<br>';
                    }
                    break;
                case 'email':
                    if ($matchesRegex == 0) {
                        echo 'Invalid email.<br>';
                    }
                    break;

                case 'address':
                    if ($matchesRegex == 0) {
                        echo 'Invalid Address.<br>';
                    }
                    break;
                case 'passwd':
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
                    break;
                case 'cfmpasswd':
                    if ($matchesRegex == 0) {
                        echo 'Password does not match.<br>';
                    }
                    break;
                default:
                    echo "Error: Code Logic Error";
                    break;
            }
            // starting of session and calling config file to connect to the database 
            session_start();
            require_once('php/config.php');

            $query = $con->prepare("INSERT INTO `user` (`username`,`password`, `name`,`email`, `mobile_number`,`address`) VALUES
            (?,?,?,?,?,?)");

            $query->bind_param(
                'ssssis',
                $username,
                $name,
                $email,
                $mobile,
                $addr,
                $pass
            ); //bind the parameters

            if ($query->execute()) {
                echo "Query executed.";
                header("Location: index.php");
            } else {
                echo "Error executing query";
            }


            $sqlOutput = mysqli_query($con, $query);
            if (!$result) {
                echo ("INSERT Failed<br>");
                echo mysqli_error($con) . "<br>";
            } else {
                echo "INSERT OK<br>";
            }

            mysqli_close($con);
        }
    } else {
        echo "Error: No fields should be empty<br>";
    }
}



?>

</html>