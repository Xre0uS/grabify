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
            return (preg_match('/[a-zA-Z0-9]+/', $_POST['username']));
            break;
        case 'name':
            return (preg_match('/[a-zA-Z\s]+/', $_POST['name']));
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
            return (preg_match('/^[!@#$@?0-9A-Za-z]{8,}$/', $_POST['passwd']) * 10000 +
                preg_match('/^.*[!@#$@?].*$/', $_POST['passwd']) * 1000 +
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

/**
 * Checking if the username has been taken by another user 
 *
 * @param String $username Retriving the username and validate against the database
 * @param Object $conn      Retriving the connection instance made previously
 * 
 * @return Boolean If the username exist in the database, it will return 1 and display and error message
 * else, it will return 0.
 * 
 */
function checkUsername($username, $conn)
{
    $query = $conn->prepare("SELECT username FROM users WHERE username=?");
    $query->bind_param('s', $username);
    $result = $query->execute();
    $result = $query->get_result();

    if (!$result) {
        die("SELECT query failed<br> " . $conn->error);
    } else {
        echo "SELECT query successful<br>";
    }

    $nrows = $result->num_rows;

    if ($nrows > 0) {
        return 1;
    } else {
        return 0;
    }
}

/**
 * Authenticate users based on the username and password supplied by the user 
 * 
 * @param String $username Retriving the username and validate against the database
 * @param String $passwd   Retriving the password and validate against the database
 * @param Object $conn      Retriving the connection instance made previously
 * 
 * @return Boolean If the credentials supplied by the user exist in the database, 
 * it will return 1 and display and error message else, it will return 0.
 * 
 */
function auth($username, $passwd, $conn)
{

    $query = $conn->prepare("SELECT password FROM users WHERE username=?");
    $query->bind_param('s', $username);
    $result = $query->execute();
    $result = $query->get_result();

    if (!$result) {
        die("SELECT query failed<br> " . $conn->error);
    } else {
        echo "SELECT query successful<br>";
    }

    $nrows = $result->num_rows;

    if ($nrows > 0) {
        $row = $result->fetch_assoc();
        $hashedpass = $row['password'];
    } else {
        echo "Username or Password is incorrect. <br>";
        return 0;
    }

    $verifypass = password_verify($passwd, $hashedpass);
    if ($verifypass == 1) {
        echo "true";
        return 1;
    } else {
        echo "false";
        echo "Username or Password is incorrect. <br>";
        return 0;
    }
}


if (isset($_POST['login'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    require('php/config.php');

    $validation = auth($username, $passwd, $con);
    if ($validation) {
        session_regenerate_id();
        $_SESSION['loginstatus'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['timeout'] = time();
        $query = $con->prepare("SELECT * FROM users WHERE username=?");
        $query->bind_param('s', $username);
        $result = $query->execute();
        $result = $query->get_result();

        echo "done query <br>";
        header("location:./home.php");
    } else {
        echo '<script>document.getElementById("loginerrormsg").style.display = "block";</script>';
    }
}

//check to see if timeout is $_SESSION['timeout'] is set 
if (isset($_SESSION["timeout"])) {
    $inactive = 600;
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
        session_destroy();
        header("location:./home.php");
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['timeout']);
    unset($_SESSION['loginstatus']);
    header("location:./home.php");
}


if (isset($_POST['signUp'])) {
    // Allow database to be accessed 
    $accessDB = 1;

    echo "Flag is " . $_POST['flag'];

    // iff usersignup() runs will $_POST['flag'] obtains a value of 1 or 0 
    // where 1 = there is missing user input and an error message will be shown 
    // and 0 = there is no missing user input and data entered by the user will be assigned to the variables to be processed by PHP
    if ($_POST['flag'] == '0') {
        session_start();
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
    } else if ($_POST['flag'] == '1') {
        echo '<script>alert("Please enter all information")</script>';
        echo '<script>document.getElementById("warninginfotext").style.display = "block";</script>';
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
                    echo '<script>document.getElementById("passLengError").style.color = "red";</script>';
                }
                if (intdiv($matchesRegex, 1000) % 10 == 0) {
                    // B is 0
                    echo 'Password must contain at least a special character.<br>';
                    echo '<script>document.getElementById("noSpecialCharacter").style.color = "red";</script>';
                }
                if (intdiv($matchesRegex, 100) % 10 == 0) {
                    // C is 0
                    echo 'Password must contain at least a number.<br>';
                    echo '<script>document.getElementById("noNumber").style.color = "red";</script>';
                }
                if (intdiv($matchesRegex, 10) % 10 == 0) {
                    // D is 0
                    echo 'Password must contain at least an uppercase letter.<br>';
                    echo '<script>document.getElementById("noAlphabets").style.color = "red";</script>';
                }
                if ($matchesRegex % 10 == 0) {
                    // E is 0 
                    echo 'Password must contain at least a lowercase letter.<br>';
                    echo '<script>document.getElementById("noAlphabets").style.color = "red";</script>';
                }
                if ($matchesRegex != 11111) {
                    $accessDB = 0;
                }
            } else if ($matchesRegex == 0) {
                switch ($i) {
                    case 'username':
                        echo  'Username should only contain alphanumeric characters.<br>';
                        echo '<script>document.getElementById("invalidUser").style.display = "block";</script>';
                        break;

                    case 'name':
                        echo 'Name should only contain alphabets.<br>';
                        echo '<script>document.getElementById("invalidName").style.display = "block";</script>';
                        break;

                    case 'mobileNo':
                        echo 'Invalid Phone Number.<br>';
                        echo '<script>document.getElementById("invalidNo").style.display = "block";</script>';
                        break;

                    case 'email':
                        echo 'Invalid email.<br>';
                        echo '<script>document.getElementById("invalidEmail").style.display = "block";</script>';
                        break;

                    case 'address':
                        echo 'Invalid Address.<br>';
                        echo '<script>document.getElementById("invalidAddr").style.display = "block";</script>';
                        break;

                    case 'cfmpasswd':
                        echo 'Password Does not match';
                        echo '<script>document.getElementById("warningpwtext").style.display = "block";</script>';
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
                echo '<script>document.getElementById("warningusernametext").style.display = "block";</script>';
            } else if ($usernameExist == 0) {
                $hashedpass = password_hash($pass, PASSWORD_BCRYPT);
                echo "hashed password: " . $hashedpass . "<br>";
                session_regenerate_id();

                $query = $con->prepare("INSERT INTO `users` (`username`,`password`, `name`,`email`, `mobile_number`,`address`) VALUES
                (?,?,?,?,?,?)");

                $query->bind_param(
                    'ssssis',
                    $username,
                    $hashedpass,
                    $name,
                    $email,
                    $mobile,
                    $addr
                ); //bind the parameters

                if ($query->execute()) {
                    echo "Query executed.";
                } else {
                    echo "Error executing query";
                }
            }
            mysqli_close($con);
        }
    } else {
        echo "Error: No fields should be empty<br>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        <?php include 'css/styles.css'; ?><?php include 'css/navbar.css'; ?><?php include 'css/login.css'; ?>
    </style>
    <script type="text/javascript" src="js/navbar.js"></script>
    <script type="text/javascript" src="js/userlogin.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="js/w3.js"></script>
</head>

<body>
    <nav>
        <div class="nav-links" id="tabnav">
            <li><a id="homeTab" href="home.php">Home</a></li>
            <li><a id="browseTab" href="browse.php">Browse</a></li>
            <li><a id="searchTab" href="search.php">Search</a></li>
            <li><a id="aboutTab" href="about.php">About</a></li>
        </div>

        <div class="logo" id="logo">
            <a href="home.php">
                <div class="logoIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 35 40">
                        <path d="M37.08,5.67a5.06,5.06,0,0,1-1.95,4.06,6.45,6.45,0,0,1-4.31,1.54,6.51,6.51,0,0,1-4.31-1.54,5.09,5.09,0,0,1-1.92-4.06A6.33,6.33,0,0,1,24.82,4H24.3Q18.66,4,14.18,9.14A15.82,15.82,0,0,0,9.84,19.78a8.32,8.32,0,0,0,3.59,7.29,13.91,13.91,0,0,0,8.13,2.16L25.92,17h8.74q-1.92,5.55-5.81,16.62Q27,38.88,20,38.88c-.54,0-1.17,0-1.87,0L20.27,33Q12.13,33,7,30.61,0,27.37,0,20.2a15.79,15.79,0,0,1,2.46-8.11,23.48,23.48,0,0,1,9.94-9A29.22,29.22,0,0,1,25.59,0h5.23a6.3,6.3,0,0,1,4.29,1.62A5.13,5.13,0,0,1,37.08,5.67Z" />
                        </g>
                        </g></svg>
                    </svg>
                </div>
                <div class="logoText">
                    Grabify
                </div>
            </a>
        </div>

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
                    <form action="#" method="post" class="login">
                        <h1>LOGIN</h1>
                        <div class="space"></div>
                        <hr />
                        <div class="space"></div>
                        <input type="text" id="usernamebox" name="username" placeholder="Username" required>
                        <input type="password" id="passwordbox" name="passwd" placeholder="Password" required>
                        <div id="loginerrormsg" class="warningtext" style="display: none;">Incorrect username or password. Please try again.</div>
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
                <a href="#" name="logout">Logout</a>
            </div>
        </div>
    </nav>

    <div id="passwdResetModel" class="fpswmodal animate" style="display: none;">
        <form class="fpsemail">
            <h1>Enter your username to reset password</h1>
            <div class="space"></div>
            <hr />
            <div class="space"></div>
            <input type="text" name="" placeholder="Username">
            <div id="resetinfotext" class="warningtext" style="display: none;">No user found</div>
            <input id="resetpwname" type="button" name="" value="SUBMIT">
        </form>
    </div>

    <div id="userSignupContainer" class="userSignupContainer" style="display: none;">
        <div id="signupmodal" class="signupmodal animate">
            <form action="#" method="post" class="signup">
                <h1>SIGN UP</h1>
                <div class="space"></div>
                <hr />
                <div class="space"></div>

                <input id="usernamesignupbox" type="text" name="username" placeholder="Username" onkeypress="usernameFilter()" required>
                <p id="invalidUser" class="warningtext" style="display: none;">Username should only contain alphanumeric characters </p>

                <input id="namesignupbox" type="text" name="name" placeholder="Name" onkeypress="nameFilter()" required>
                <p id="invalidName" class="warningtext" style="display: none;">Name should only contain alphabets.</p>

                <input id="mobilenosignupbox" type="text" name="mobileNo" placeholder="Mobile Number" onkeypress="mobilenoFilter()" required>
                <p id="invalidNo" class="warningtext" style="display: none;">Invalid Phone Number. </p>

                <input id="emailsignupbox" type="email" name="email" placeholder="Email" onkeypress="emailFilter()" required>
                <p id="invalidEmail" class="warningtext" style="display: none;">Invalid email. </p>

                <input id="addrsignupbox" type="text" name="address" placeholder="Address e.g. 123 Pine St" onkeypress="addrFilter()" required>
                <p id="invalidAddr" class="warningtext" style="display: none;">Invalid Address </p>

                <input id="tpwsignupbox" type="password" name="passwd" placeholder="Password" onkeypress="tpwFilter()" required>
                <input id="pwsignupbox" type="password" name="cfmpasswd" placeholder="Confirm password" onkeypress="pwFilter()" required>
                <input id='parseflag' type='hidden' name='flag'>
                <ul>
                    <li id="passLengError" class="warningtext" style="display: none;">Password must be at least 8 characters long</li>
                    <li id="noSpecialCharacter" class="warningtext" style="display: none;">Password must contain at least 1 special character</li>
                    <li id="noNumber" class="warningtext" style="display: none;">Password must contain at least a number</li>
                    <li id="noAlphabets" class="warningtext" style="display: none;">Password must contain at least an uppercase and a lowercase letter</li>
                </ul>
                <div class="space"></div>
                <div id="warninginfotext" class="warningtext" style="display: none;">Please enter all the information </div>
                <div id="warningpwtext" class="warningtext" style="display: none;"> Passwords do not match </div>
                <div id="emailerrormsg" class="warningtext" style="display: none"> Invalid email address</div>
                <div id="warningusernametext" class="warningtext" style="display: none;">This username is already taken</div>

                <input type="submit" name="signUp" value="SUBMIT" onclick="usersignup()">
            </form>
        </div>
    </div>

    <!--  <div id="confirmmodal" class="confirmmodal animate" style="display: none;">
        <form class="confirmtxt">
            <h1>Sign up success</h1>
            <div class="space"></div>
            <hr />
            <div class="bigspace"></div>
            <input type="button" name="" value="OK" onclick="location.reload();">
        </form>
    </div> -->

    <div id="resetconfirmmodal" class="confirmmodal animate" style="display: none;">
        <form class="confirmtxt">
            <h1 id="resettext"></h1>
            <div class="space"></div>
            <hr />
            <div class="bigspace"></div>
            <input type="button" name="" value="OK" onclick="location.reload();">
        </form>
    </div>

    <div id="navSpace" class="navSpace"></div>

    <!-- NAVBAR -->

</body>

<!--<script>
    function staticUserLogin() {
        sessionStorage.setItem("loginstatus", true);
        sessionStorage.setItem("loggedinid", "");
        sessionStorage.setItem("loggedusername", "User");
        location.reload();
    }

    function staticReload() {
        location.reload();
    }
</script>
-->

</html>