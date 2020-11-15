<head>
    <script type="text/javascript" src="js/bislogin.js"></script>
</head>

<body>

    <div id="loginBtn" class="loginBtn" style="display: none; " onclick="shloginmodal()">
        <button id="login-btn" class="login-btn">
            <div class="login-txt">
                BUSINESS LOGIN
            </div>
        </button>
    </div>

    <div id="loginModalContainer" class="loginModalContainer" style="display: none;">
        <div id="login-modal" class="login-modal animate">
            <form class="login">
                <div class="modalHeader">LOGIN</div>
                <div class="space"></div>
                <hr />
                <div class="space"></div>
                <input type="text" id="usernamebox" name="" placeholder="Username" value="">
                <input type="password" id="passwordbox" name="" placeholder="Password" value="">
                <input type="checkbox" class="usercheckbox" id="usercheckbox" name="">
                <label for="usercheckbox" class="staylogged" style="font-size: 14px;">Stay logged in</label>
                <div class="bigspace"></div>
                <div class="bigspace"></div>
                <div id="wrongpassword" class="warningtext" style="display: none">Incorrect password</div>
                <div id="wronguser" class="warningtext" style="display: none">User not found</div>
                <input type="button" name="" value="LOGIN" onclick="loginBis()">
            </form>

            <div>
                <a id="forgotpsw" class="psw" onclick="shloginmodal(), shfpswmodal()">Forgot
                    password?</a>
                <div class="space"></div>
                <p class="signup">New business?<a class="signuplink" onclick="shloginmodal(), shsignupmodal()">
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
            <a href="listReview.php">My items</a>
            <a href="#" onclick="logout()">Logout</a>
        </div>
    </div>

    <div id="fpswmodal" class="fpswmodal animate" style="display: none;">
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
            <form class="signup">
                <div class="modalHeader">SIGN UP</div>
                <div class="space"></div>
                <hr />
                <div class="space"></div>

                <input id="usernamesignupbox" type="text" name="" placeholder="Username">
                <input id="cnamesignupbox" type="text" name="" placeholder="Company Name">
                <input id="emailsignupbox" type="text" name="" placeholder="Email">
                <input id="numbersignupbox" type="text" name="" placeholder="Mobile Number">
                <input id="addresssignupbox" type="text" name="" placeholder="Address">
                <input id="tpwsignupbox" type="password" name="" placeholder="Password">
                <input id="pwsignupbox" type="password" name="" placeholder="Confirm password">
                <div class="space"></div>
                <div id="warninginfotext" class="warningtext" style="display: none;">Please enter all the information</div>
                <div id="warningpwtext" class="warningtext" style="display: none;">The two passwords do not match</div>
                <div id="warningusernametext" class="warningtext" style="display: none;">This username is already taken</div>
                <input type="button" name="" value="SUBMIT" onclick="companySignup()">
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