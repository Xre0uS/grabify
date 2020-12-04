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
                <div class="modalHeader">ADMIN LOGIN</div>
                <div class="space"></div>
                <hr />
                <div class="space"></div>
                <input type="text" id="unameField" name="" placeholder="Username">
                <input type="password" id="pwField" name="" placeholder="Password" value="">
                <div id="loginWarn" class="warningtext"></div>
                <div class="bigspace"></div>
                <input type="button" name="" value="LOGIN" onclick="loginRequest()">
            </form>

            <div>
                <div class="space"></div>
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