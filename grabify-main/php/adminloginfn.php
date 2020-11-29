<head>
    <script type="text/javascript" src="js/adminlogin.js"></script>
</head>

<body>

    <div id="loginBtn" class="loginBtn" style="display: none; " onclick="shloginmodal()">
        <button id="login-btn" class="login-btn">
            <div class="login-txt">
                ADMIN LOGIN
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
                <input type="button" name="" value="LOGIN" onclick="loginAdmin()">
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
            <a href="listReview.php">Manage</a>
            <a href="#" onclick="logout()">Logout</a>
        </div>
    </div>

</body>

<script>
    window.onload = checkLoggedin();
</script>