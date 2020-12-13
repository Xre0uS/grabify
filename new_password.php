<?php
include "php/lookup.php";
// Check if session is not registered, if it is not, the user will be redirected back to the login page.
session_start();
if (!isset($_GET["key"]) && !isset($_GET["action"])
&& ($_GET['action'] != "reset")) {
    TraversalLogs();
    header("location:home.php");
}
include 'php/userloginfn.php';
?>

<?php
if (
    isset($_GET["key"]) && isset($_GET["action"])
    && ($_GET['action'] == "reset") && !isset($_POST["action"])
) {
    require_once "php/config.php";

    $token = $_GET["key"];
    $curDate = date("Y-m-d H:i:s");

    $query = $con->prepare("SELECT * FROM `password_reset_temp` WHERE csrfToken=?");
    $query->bind_param('s', $token);
    $result = $query->execute();
    $result = $query->get_result();

    $nrows = $result->num_rows;

    while ($row = $result->fetch_assoc()) { //placing the data into its appropriate location in the table
        $email = $row['email'];
        //echo $email;
    }
}
?>

<html>

<head>
    <title>Password Recovery</title>
    <script type="text/javascript" src="js/userlogin.js"></script>
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
    border: 2px solid var(--primaryColor);
    padding: 12px;
    outline: none;
    color: var(--grey);
    transition: 0.2s ease;
    cursor: pointer;
    font-size: 16px;
    color: var(--primaryColor);
    align-content: center;
}

.updatekbtn:hover {
    background: var(--primaryColor);
    color: #ffffff;
  }
  #formItem label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}
    </style>
</head>

<body>
    <form method="post" action="php/resetPasswd.php">
        <br><br>
        <label style="padding-left:600px"><strong>Enter New Password:</strong></label><br />
        <input type="password" id="tpwsignupbox" name="passwd" onkeypress="userInputFilters('tpwsignupbox')" required />
        <br><br>
        <label style="padding-left:600px"><strong>Re-Enter New Password:</strong></label><br />
        <input type="password" id="pwsignupbox" name="cfmpasswd" onkeypress="userInputFilters('pwsignupbox')" required />
        <br><br>
        <input type="hidden" name="email" value="<?php echo $email; ?>" />

        <?php if (isset($_SESSION["rpasswdFieldEmpty"])) { ?>
            <p style="text-align:center; color:red;" class="warningtext"><?= $_SESSION["rpasswdFieldEmpty"]; ?></p>
        <?php } ?>

        <input type="submit" class="updatekbtn" name="updatePasswd" value="Reset Password" />
    </form>
</body>

</html>