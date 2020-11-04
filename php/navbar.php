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
    <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="js/w3.js"></script>
</head>

<body onload="checkLogin(), checkActive()">
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
            <div id="loginbtncontainer" class="loginbtncontainer" style="display: none;" onclick="shloginmodel()">
                <button id="login-btn" class="login-btn">
                    <div class="login-txt">
                        LOGIN
                    </div>
                </button>
            </div>

            <div id="loginModalContainer" class="loginModalContainer" style="display: none;">
                <div id="loginModal" class="loginModal animate">
                    <form class="login">
                        <h1>LOGIN</h1>
                        <div class="space"></div>
                        <hr />
                        <div class="space"></div>
                        <input type="text" id="usernamebox" name="" placeholder="Username" value="">
                        <input type="password" id="passwordbox" name="" placeholder="Password" value="">
                        <input type="checkbox" class="usercheckbox" id="usercheckbox" name="">
                        <label for="usercheckbox" class="staylogged">Stay logged in</label>
                        <div class="bigspace"></div>
                        <div class="bigspace"></div>
                        <div id="wrongpassword" class="warningtext" style="display: none">Incorrect password</div>
                        <div id="wronguser" class="warningtext" style="display: none">User not found</div>
                        <input type="button" name="" value="LOGIN" onclick="staticUserLogin()">
                    </form>

                    <div>
                        <a id="forgotpsw" class="psw" onclick="shloginmodel(), shfpswmodal()">Forgot
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
                <a href="#" onclick="logout()">Logout</a>
            </div>
        </div>
    </nav>

    <div id="fpswmodal" class="fpswmodal animate" style="display: none;">
        <form class="fpsemail">
            <h1>Enter your username to reset password</h1>
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
            <form class="signup">
                <h1>SIGN UP</h1>
                <div class="space"></div>
                <hr />
                <div class="space"></div>

                <input id="usernamesignupbox" type="text" name="" placeholder="Username">
                <input id="emailsignupbox" type="text" name="" placeholder="Email">
                <input id="tpwsignupbox" type="password" name="" placeholder="Password">
                <input id="pwsignupbox" type="password" name="" placeholder="Confirm password">
                <div class="space"></div>
                <div id="warninginfotext" class="warningtext" style="display: none;">Please enter all the information</div>
                <div id="warningpwtext" class="warningtext" style="display: none;">The two passwords do not match</div>
                <div id="warningusernametext" class="warningtext" style="display: none;">This username is already taken</div>
                <input type="button" name="" value="SUBMIT" onclick="usersignup()">
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

    <div id="navSpace" class="navSpace"></div>

    <!-- NAVBAR -->

</body>

<script>
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