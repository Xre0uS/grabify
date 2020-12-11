<?php
// Check if session is not registered, if it is not, the user will be redirected back to the login page.
session_start();
if (!isset($_SESSION['loginstatus']) || $_SESSION['loginstatus'] == 'false' || $_SESSION['loginstatus'] == 'temp') {
    header("location:home.php");
} else if ($_SESSION['username'] == null) {
    header("location:home.php");
} else if (!isset($_SESSION['authentication']) || $_SESSION['authentication'] != '2FA') {
    header("location:home.php");
}
include 'php/userloginfn.php';
?>
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
        <?php

        require_once "php/config.php";

        $query = $con->prepare("SELECT `email`, `mobile_number`, `address` FROM users WHERE username=?");
        $query->bind_param('s', $_SESSION['username']);
        $result = $query->execute();
        $result = $query->get_result();

        $nrows = $result->num_rows;
        echo "<form action='php/update.php' method='POST'>";
        echo "<div class='updateinfocontainer'>";
        while ($row = $result->fetch_assoc()) { //placing the data into its appropriate location in the table
            $email = $row['email'];
            $mobile = $row['mobile_number'];
            $address = $row['address'];
        }
        $con->close();
        ?>
        <!-- echo "<input id='emailbox' type='email' name='email' placeholder='Email' value='" . $row['email'] . "' onkeypress='userInputFilters('emailbox')' required>";
            echo "<input id='numbox' type='text' name='mobileNo' placeholder='Mobile Number' value='" . $row['mobile_number'] . "' onkeypress='userInputFilters('numbox')' required>";
            echo "<input id='addbox' type='text' name='address' placeholder='Address e.g. 123 Pine St' value='" . $row['address'] . "' onkeypress='userInputFilters('addbox')' required>"; -->
        <form action='php/update.php' method='POST'>
            <div class='updateinfocontainer'>
                <input id='emailbox' type='email' name='email' placeholder='Email' value='<?php echo $email; ?>' onkeypress="userInputFilters('emailbox')" required>
                <?php if (isset($_SESSION["uEmailError"])) { ?>
                    <p style="padding-left:250px" class="warningtext"><?= $_SESSION["uEmailError"]; ?></p><br>
                <?php } ?>

                <input id='numbox' type='text' name='mobileNo' placeholder='Mobile Number' value='<?php echo $mobile; ?>' onkeypress="userInputFilters('numbox')" required>
                <?php if (isset($_SESSION["uMobileError"])) { ?>
                    <p style="padding-left:250px" class="warningtext"><?= $_SESSION["uMobileError"]; ?></p><br>
                <?php } ?>

                <input id='addbox' type='text' name='address' placeholder='Address e.g. 123 Pine St' value='<?php echo $address; ?>' onkeypress="userInputFilters('addbox')" required>
                <?php if (isset($_SESSION["uAddressError"])) { ?>
                    <p style="padding-left:250px" class="warningtext"><?= $_SESSION["uAddressError"]; ?></p><br>
                <?php } ?>

            </div>
            <input id='updateParseflag' type='hidden' name='flag'>
            <?php if (isset($_SESSION["profileFieldEmpty"])) { ?>
                <p style="padding-left:350px" class="warningtext"><?= $_SESSION["profileFieldEmpty"]; ?></p><br>
            <?php } ?>

            <div class='updatebtncontainer'>
                <input type='submit' name='update' class='updatekbtn' onclick='updateinfo()' value='UPDATE'>
            </div>
        </form>



        <?php
        // }
        // echo "<input id='updateParseflag' type='hidden' name='flag'>";
        // echo "<div class='updatebtncontainer'>";
        // echo "<input type='submit' name='update' class='updatekbtn' onclick='updateinfo()' value='UPDATE'>";
        // echo "</div></form>";
        // $con->close();
        ?>

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

        <form action='php/update.php' method='POST'>
            <div class="updatepwcontainer">
                <input id="oldpwbox" type="password" name="oPasswd" placeholder="Old Password" onkeypress="userInputFilters('oldpwbox')" required>
                <?php if (isset($_SESSION["wrongOldPass"])) { ?>
                    <p style="padding-left:350px" class="warningtext"><?= $_SESSION["wrongOldPass"]; ?></p>
                <?php } ?>

                <?php if (isset($_SESSION["samePass"])) { ?>
                    <p style="padding-left:300px" class="warningtext"><?= $_SESSION["samePass"]; ?></p>
                <?php } ?>

                <input id="newpwbox" type="password" name="passwd" placeholder="New Password" onkeypress="userInputFilters('newpwbox')" required>
                <input id="cnewpwbox" type="password" name="cfmpasswd" placeholder="Confirm New Password" onkeypress="userInputFilters('cnewpwbox')" required>
            </div>

            <?php if (isset($_SESSION["passwdFieldEmpty"])) { ?>
                <p style="padding-left:350px" class="warningtext"><?= $_SESSION["passwdFieldEmpty"]; ?></p>
            <?php } ?>

            <?php if (isset($_SESSION["notMatch"])) { ?>
                <p style="padding-left:350px" class="warningtext"><?= $_SESSION["notMatch"]; ?></p>
            <?php } ?>



            <input id='pUpdateParseflag' type='hidden' name='flag'>
            <input type='submit' name='cPasswdBtn' class='updatekbtn' onclick="updatepasswd()" value='UPDATE'>

        </form>


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
            <form action="profile.php" method="POST">
                <div class="delaccbtncontainer" onclick="return confirm('Are you sure you want to delete?')">
                    <input type="submit" class="delacc" name="delete" value="DELETE ACCOUNT">
                </div>
            </form>
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
                <input type="submit" value="OK" onclick="gohome()">
            </form>
        </div>

        <div id="delmodal" class="confirmmodal animate" style="display: none;">
            <form class="confirmtxt">
                <h1>Your account has been deleted</h1>
                <div class="space"></div>
                <hr />
                <div class="bigspace"></div>
                <input type="button" value="OK" onclick="gohome()">
            </form>
        </div>

    </div>

</body>
<?php

// iff run if the user click on 'yes' in the confirm model showm  
if (isset($_POST["delete"])) {

    //calling the php script to connect to the database
    require "php/config.php";

    //assigning variables
    extract($_SESSION);
    // $username =  $_SESSION["username"];
    //print_r($_SESSION);


    // echo "Deleting data from the database. <br>";
    $query = $con->prepare("Delete FROM `users` WHERE username=?");

    $query->bind_param('s', $username);

    if ($query->execute()) {
        //echo "Delete Successfully.";
        echo " <script> delusermodel(); </script>";
    } else {
        // echo "Unable to Delete.";
        echo " <script> alert('Delete Failed'); </script>";
    }
}

// displaying output to tell user that the password has been updated successfully 
if (isset($_SESSION["pUpdateSuccess"])) {
    if ($_SESSION["pUpdateSuccess"] == 1) {
        unset($_SESSION["pUpdateSuccess"]);
        echo " <script> updatepasswordmodel(); </script>";
    }
}

// displaying output to tell user that the user information has been updated successfully 
if (isset($_SESSION["iUpdateSuccess"])) {
    if ($_SESSION["iUpdateSuccess"] == 1) {
        unset($_SESSION["iUpdateSuccess"]);
        echo " <script> updateinfomodel(); </script>";
    }
}
?>

</html>