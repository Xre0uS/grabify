<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        <?php include 'css/styles.css'; ?><?php include 'css/about.css' ?><?php include 'css/userProfile.css' ?>
    </style>
    <script type="text/javascript" src="js/userProfile.js"></script>
    <title>Grabify - Profile</title>
</head>

<body>

    <?php include 'php/navbar.php'; ?>

    <div class="userinfocontainer">
        <div id="avatarcontainer" class="avatarcontainer">
            <div class="avatarbg">
                <svg xmlns="http://www.w3.org/2000/svg" width="126" height="126" viewBox="0 0 126 126">
                    <circle id="Ellipse_1" data-name="Ellipse 1" cx="63" cy="63" r="63" fill="#cfcfcf" />
                </svg>
            </div>
            <div class="avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="72.859" height="72.859" viewBox="0 0 72.859 72.859">
                    <path id="ic_person_24px" d="M40.43,40.43A18.215,18.215,0,1,0,22.215,22.215,18.21,18.21,0,0,0,40.43,40.43Zm0,9.107C28.271,49.537,4,55.639,4,67.752v9.107H76.859V67.752C76.859,55.639,52.588,49.537,40.43,49.537Z" transform="translate(-4 -4)" fill="#292929" />
                </svg>
            </div>
        </div>

        <div id="browsetrigger" class="browsecontainer" onclick="">
            <div class="uploadbtn">
                <input class="uploadbtn" type="file" onchange="readImage(this)">
            </div>
        </div>

        <div class="bigspace"></div>
        <div class="bigspace"></div>

        <div class="username">
            <h1 id="username"></h1>
        </div>

        <div class="bigspace"></div>
        <div class="hrcontainer">
            <hr />
        </div>
        <div class="bigspace"></div>

        <div class="updateinfocontainer">
            <input id="emailbox" type="text" name="" placeholder="Email">
            <input id="numbox" type="text" name="" placeholder="Mobile Number">
            <input id="addbox" type="text" name="" placeholder="Address">
        </div>

        <div id="warninginfotext" class="infowarningtext" style="display: none;">Please enter all the information</div>
        <div class="updatebtncontainer" onclick="updateinfo()">
            <div class="updatekbtn">
                UPDATE
            </div>
        </div>

        <div class="bigspace"></div>
        <div class="updatepassword">
            <h4>UPDATE PASSWORD</h4>
        </div>

        <div class="seperatorcontainer">
            <div class="bigspace"></div>
            <div class="hrcontainer">
                <hr />
            </div>
            <div class="bigspace"></div>
        </div>

        <div class="updatepwcontainer">
            <input id="oldpwbox" type="password" name="" placeholder="Old Password">
            <input id="newpwbox" type="password" name="" placeholder="New Password">
            <input id="cnewpwbox" type="password" name="" placeholder="Confirm New Password">
        </div>

        <div id="misspwtext" class="infowarningtext" style="display: none;">Please enter your passowrd</div>
        <div id="diffpwtext" class="infowarningtext" style="display: none;">The passwords do not match</div>
        <div id="wrongpwtext" class="infowarningtext" style="display: none;">Wrong old password</div>
        <div class="updatebtncontainer" onclick="updatepassword()">
            <div class="updatekbtn">
                UPDATE
            </div>
        </div>

        <div class="bigspace"></div>
        <div class="bigspace"></div>
        <div class="bigspace"></div>
        <div class="bigspace"></div>
        <div class="hrcontainer">
            <hr />
        </div>
        <div class="bigspace"></div>
        <div class="bigspace"></div>

        <div class="accactioncontainer">

            <div class="deaccbtncontainer" onclick="deactivateuser()">
                <div class="deacc">
                    DEACTIVATE ACCOUNT
                </div>
            </div>
            <div class="bigspace"></div>
            <div class="delaccbtncontainer" onclick="deluser()">
                <div class="delacc">
                    DELETE ACCOUNT
                </div>
            </div>
        </div>

        <div id="updateinfomodal" class="confirmmodal animate" style="display: none;">
            <form class="confirmtxt">
                <h1>Information update success</h1>
                <div class="space"></div>
                <hr />
                <div class="bigspace"></div>
                <input type="button" name="" value="OK" onclick="location.reload();">
            </form>
        </div>

        <div id="updatepasswordmodal" class="confirmmodal animate" style="display: none;">
            <form class="confirmtxt">
                <h1>Password update success</h1>
                <div class="space"></div>
                <hr />
                <div class="bigspace"></div>
                <input type="button" name="" value="OK" onclick="location.reload();">
            </form>
        </div>

        <div id="deactivatemodal" class="confirmmodal animate" style="display: none;">
            <form class="confirmtxt">
                <h1>Your account has been deactivated</h1>
                <div class="space"></div>
                <hr />
                <div class="bigspace"></div>
                <input type="button" name="" value="OK" onclick="gohome()">
            </form>
        </div>

        <div id="delmodal" class="confirmmodal animate" style="display: none;">
            <form class="confirmtxt">
                <h1>Your account has been deleted</h1>
                <div class="space"></div>
                <hr />
                <div class="bigspace"></div>
                <input type="button" name="" value="OK" onclick="gohome()">
            </form>
        </div>

    </div>

</body>

</html>