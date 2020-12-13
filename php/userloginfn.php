<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} else {
    session_regenerate_id();
}

if (isset($_SESSION["locked"])) {
    $difference = time() - $_SESSION["locked"];
    if ($difference > 20) {
        unset($_SESSION["locked"]);
        unset($_SESSION["loginAttempts"]);
    }
}

?>

<?php
if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
    $secret = '6LdFov4ZAAAAAFKILOLHu1-kI1YLpFfkIt2vz2xH';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if ($responseData->success) {
        $succMsg = 'Your contact request have submitted successfully.';
    } else {
        $errMsg = 'Robot verification failed, please try again.';
    }
}
?>

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
    <script src='https://www.google.com/recaptcha/api.js' async defer> </script>
</head>

<body>
    <nav>
        <div class="nav-links" id="tabnav">
            <li><a id="homeTab" href="home.php">Home</a></li>
            <li><a id="browseTab" href="products.php">Products</a></li>
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
            <div id="loginbtncontainer" class="loginbtncontainer" style="display: none;" onclick="shloginmodel()">
                <button id="login-btn" class="login-btn">
                    <div class="login-txt">
                        LOGIN
                    </div>
                </button>
            </div>

            <div id="loginModalContainer" class="loginModalContainer" style="display: none;">
                <div id="login-modal" class="login-modal animate">
                    <form action="php/userlogin.php" method="post" class="login">
                        <h1>LOGIN</h1>
                        <div class="space"></div>
                        <hr />
                        <?php if (isset($_SESSION["loginError"])) { ?>
                            <p style="text-align:center" class="warningtext"><?= $_SESSION["loginError"]; ?></p>
                        <?php } ?>
                        <?php if (isset($_SESSION["blocked"])) { ?>
                            <p style="text-align:center" class="warningtext"><?= $_SESSION["blocked"]; ?></p>
                        <?php } ?>
                        <div class="space"></div>
                        <input type="text" id="usernamebox" name="username" placeholder="Username" onkeypress="userInputFilters('usernamebox')" required>
                        <input type="password" id="passwordbox" name="passwd" placeholder="Password" onkeypress="userInputFilters('passwordbox')" required>

                        <input type="checkbox" class="usercheckbox" id="usercheckbox" name="rmbMe">
                        <label for="usercheckbox" class="staylogged">Stay logged in</label>

                        <input id='loginParseflag' type='hidden' name='flag'>
                        <div class="bigspace"></div>
                        <div class="g-recaptcha" data-sitekey="6LdFov4ZAAAAACTNQftPShIGjRXGKioxcTOp2eeY" required> </div>
                        <div class="bigspace"></div>

                        <p id="countdown"></p>
                        <?php
                        if (isset($_SESSION["loginAttempts"])) {

                            if ($_SESSION["loginAttempts"] > 3) {
                                $_SESSION["locked"] = time();
                                if (isset($_SESSION["failAttempts"])) {
                                    echo "<script>startCountdown(" . $_SESSION["failAttempts"] . ");</script>";
                                } else {
                                    echo "Code Logic Error";
                                }
                            } else { ?>
                                <input type="submit" name="login" value="LOGIN" onclick="userLogin()">
                            <?php }
                        } else { ?>
                            <input type="submit" name="login" value="LOGIN" onclick="userLogin()">
                        <?php } ?>
                    </form>

                    <div>
                        <a id="forgotpsw" class="psw" onclick="shloginmodel(), passwdResetModal()">Forgot
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
                <a href="favouritespage.php">My Favourites</a>
                <a href="booking.php">My Bookings</a>
                <a href="logout.php" onclick="logout()">Logout</a>
            </div>
        </div>
    </nav>

    <div id="passwdResetModel" class="fpswmodal animate" style="display: none;">
        <form action="php/resetPasswd.php" method="post" class="fpsemail">
            <h1>Password Recovery</h1>
            <div class="space"></div>
            <hr />
            <div class="space"></div>
            <?php if (isset($_SESSION["username"])) { ?>
                <p style="text-align:center; padding-left:15%;" class="warningtext"><?= $_SESSION["resetEmailError"]; ?></p>
            <?php } ?>

            <?php if (isset($_SESSION["userNotFound"])) { ?>
                <p style="text-align:center; padding-left:15%;" class="warningtext"><?= $_SESSION["userNotFound"]; ?></p>
            <?php } ?>

            <input id='resetParseflag' type='hidden' name='flag'>
            <input type="text" id="resetPasswdUsername" name="resetPasswdUsername" placeholder="Username" onkeypress="userInputFilters('resetPasswdUsername')"  required>
            <input type="email" id="resetPasswdEmail" name="resetPasswdEmail" placeholder="Email" onkeypress="userInputFilters('resetPasswdEmail')"  required>
            <div class="g-recaptcha" data-sitekey="6LdFov4ZAAAAACTNQftPShIGjRXGKioxcTOp2eeY" required> </div>
            <input id="resetpwname" type="submit" name="resetPasswd" value="SUBMIT" onclick="passwdRecovery()">
        </form>
    </div>

    <div id="userSignupContainer" class="userSignupContainer" style="display: none;">
        <div id="signupmodal" class="signupmodal animate">
            <form action="php/usersignup.php" method="post" class="signup">
                <h1>SIGN UP</h1>
                <div class="space"></div>
                <hr />
                <div class="space"></div>

                <input id="usernamesignupbox" type="text" name="username" placeholder="Username" onkeypress="userInputFilters('usernamesignupbox')" required>
                <?php if (isset($_SESSION["sUsernameError"])) { ?>
                    <p style="text-align:center" class="warningtext"><?= $_SESSION["sUsernameError"]; ?></p>
                <?php } ?>

                <input id="namesignupbox" type="text" name="name" placeholder="Name" onkeypress="userInputFilters('namesignupbox')" required>
                <?php if (isset($_SESSION["sNameError"])) { ?>
                    <p style="text-align:center" class="warningtext"><?= $_SESSION["sNameError"]; ?></p>
                <?php } ?>

                <input id="mobilenosignupbox" type="text" name="mobileNo" placeholder="Mobile Number" onkeypress="userInputFilters('mobilenosignupbox')" required>
                <?php if (isset($_SESSION["sMobileError"])) { ?>
                    <p style="text-align:center" class="warningtext"><?= $_SESSION["sMobileError"]; ?></p>
                <?php } ?>

                <input id="emailsignupbox" type="email" name="email" placeholder="Email" onkeypress="userInputFilters('emailsignupbox')" required>
                <?php if (isset($_SESSION["sEmailError"])) { ?>
                    <p style="text-align:center" class="warningtext"><?= $_SESSION["sEmailError"]; ?></p>
                <?php } ?>

                <input id="addrsignupbox" type="text" name="address" placeholder="Address e.g. 123 Pine St" onkeypress="userInputFilters('addrsignupbox')" required>
                <?php if (isset($_SESSION["sAddressError"])) { ?>
                    <p style="text-align:center" class="warningtext"><?= $_SESSION["sAddressError"]; ?></p>
                <?php } ?>
                <p id="invalidAddr" class="warningtext" style="display: none;">Invalid Address </p>

                <input id="tpwsignupbox" type="password" name="passwd" placeholder="Password" onkeypress="userInputFilters('tpwsignupbox')" required>
                <input id="pwsignupbox" type="password" name="cfmpasswd" placeholder="Confirm password" onkeypress="userInputFilters('pwsignupbox')" required>
                <input id='parseflag' type='hidden' name='flag'>
                <ul>
                    <li id="passLengError" style="display: block;">Password must be at least 8 characters long</li>
                    <li id="noSpecialCharacter" style="display: block;">Password must contain at least 1 special character</li>
                    <li id="noNumber" style="display: block;">Password must contain at least a number</li>
                    <li id="noAlphabets" style="display: block;">Password must contain at least an uppercase and a lowercase letter</li>
                </ul>
                <div class="space"></div>
                <?php if (isset($_SESSION["sNoInput"])) { ?>
                    <p style="text-align:center" class="warningtext"><?= $_SESSION["sNoInput"]; ?></p>
                <?php } ?>
                <?php if (isset($_SESSION["sPasswdNotMatch"])) { ?>
                    <p style="text-align:center" class="warningtext"><?= $_SESSION["sPasswdNotMatch"]; ?></p>
                <?php } ?>
                <?php if (isset($_SESSION["sUsernameTaken"])) { ?>
                    <p style="text-align:center" class="warningtext"><?= $_SESSION["sUsernameTaken"]; ?></p>
                <?php } ?>

                <div class="g-recaptcha" data-sitekey="6LdFov4ZAAAAACTNQftPShIGjRXGKioxcTOp2eeY"> </div>

                <input type="submit" name="signUp" value="SUBMIT" onclick="usersignup()">
            </form>
        </div>
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

    <div id="navSpace" class="navSpace"></div>

    <!-- NAVBAR -->

</body>
<?php 

if (isset($_SESSION["signUpSuccess"])) {
    echo "<script>alert('An activation link has been sent to your email.');</script>";
    unset($_SESSION['signUpSuccess']);
} 

if (isset($_SESSION['rUpdateSuccess'])) {
    echo "<script>alert('Password is changed successfully');</script>";
    unset($_SESSION['rUpdateSuccess']);
}

if (isset($_SESSION['recoveryTimeout'])) {
    echo "<script>alert('Password recovery link has expired.');</script>";
    unset($_SESSION['recoveryTimeout']);
}

if (isset($_SESSION['emailSent'])) { 
    if($_SESSION['emailSent'] == 1){
        echo "<script>alert('An email has been sent to you with instructions on how to reset your password.');</script>";
        unset($_SESSION['emailSent']);
    }
    else if ($_SESSION['emailSent'] == 0){
        echo "<script>alert('Error sending mail');</script>";
        unset($_SESSION['emailSent']);
    }

}

if (isset($_SESSION['deleted'])) {
    echo "<script>alert('Account Deleted Successfully.');</script>";
    unset($_SESSION['deleted']);
}

?>

<script>
    window.onload = checkLoggedin();
</script>
