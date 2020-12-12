<?php
include "php/lookup.php";
// Check if session is not registered, if it is not, the user will be redirected back to the login page.
session_start();

if (
    !isset($_GET["key"]) && !isset($_GET["action"])
    && ($_GET['action'] != "activate")
) {
    TraversalLogs();
    header("location:home.php");
}
// include 'php/userloginfn.php';
?>

<?php
if (
    isset($_GET["key"]) && isset($_GET["action"])
    && ($_GET['action'] == "activate") && !isset($_POST["action"])
) {
    $_SESSION['token'] = $_GET["key"];
    
}
    if (isset($_POST['activateAccount'])) {
        include "php/verify.php";
        

        $username = $_POST['username'];
        $passwd = $_POST['password'];
        if (
            !empty($username) &&
            !empty($passwd)
        ) {
            require_once "php/config.php";
            $validation = auth($username, $passwd, $con);

            if ($validation) {

                //print_r("vaildated");
                // // remove all session data 
                // session_unset();
                // session_regenerate_id();

                $_SESSION['activation'] = 'temp';
                // $_SESSION['token'] = $_GET["key"];
                
                header("location:activateaccount.php");
            } else {
                echo "<script>document.getElementById('credsError').style.display = 'block';</script>";
                mysqli_close($con);
               $_SESSION["loginAttempts"] += 1;
               // $_SESSION['loginError'] = "Your username or password entered is incorrect";
                //header("location:activate_login.php");
            }
        }
    }

    // $query = $con->prepare("SELECT * FROM `password_reset_temp` WHERE csrfToken=?");
    // $query->bind_param('s', $token);
    // $result = $query->execute();
    // $result = $query->get_result();

    // $nrows = $result->num_rows;

    // while ($row = $result->fetch_assoc()) { //placing the data into its appropriate location in the table
    //     $email = $row['email'];
    //     //echo $email;
    // }


if (isset($_SESSION["loginAttempts"])) {
    if ($_SESSION["loginAttempts"] > 3) {
        $_SESSION["failAttempts"] += 1;
    }
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

<html>

<head>
    <title>Account Activation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="js/userlogin.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer> </script>
    <style>
        .error p {
            color: #FF0000;
            font-size: 20px;
            font-weight: bold;
            margin: 50px;
        }

        .updatekbtn {
            border: 0;
            background: none;
            display: block;
            margin: 10px auto;
            text-align: center;
            border: 2px solid #e66f0e;
            padding: 12px;
            outline: none;
            color: var(--grey);
            transition: 0.2s ease;
            cursor: pointer;
            font-size: 16px;
            color: #e66f0e;
            align-content: center;
        }

        .updatekbtn:hover {
            background: #e66f0e;
            color: #ffffff;
        }

        #formItem label {
            display: block;
            text-align: center;
            line-height: 150%;
            font-size: .85em;
        }

        .updateinfocontainer {
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #414141;
            padding: 14px 10px;
            width: 330px;
            outline: none;
            color: #313131;
            transition: 0.5s;
        }

        .updateinfocontainer:focus {
            border-color: var(--primaryColor);
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Please enter your login credentials to activate your account</h2>
    <br><br>
    <form method="post" action="activate_login.php">

        <label style="padding-left:600px"><strong>Username:</strong></label><br />
        <input id="usernamebox" class="updateinfocontainer" type="text" name="username" onkeypress="userInputFilters('usernamebox')" required />
        <br>
        <label style="padding-left:600px"><strong>Password:</strong></label><br />
        <input id="passwordbox" class="updateinfocontainer" type="password" name="password" onkeypress="userInputFilters('passwordbox')" required />
        <br>
        <div style="padding-left:40%" class="g-recaptcha" data-sitekey="6LdFov4ZAAAAACTNQftPShIGjRXGKioxcTOp2eeY"> </div>
        <p id="credsError" class="warningtext" style="color:red;display: none;">Incorrect username or password entered </p>
        <br>
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
                <input type="submit" class="updatekbtn" name="activateAccount" value="Activate Account" onclick="userLogin()" />
            <?php }
        } else { ?>
            <input type="submit" class="updatekbtn" name="activateAccount" value="Activate Account" onclick="userLogin()" />
        <?php } ?>

    </form>
</body>

</html>