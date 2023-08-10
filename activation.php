<?php
// Check if session is not registered, if it is not, the user will be redirected back to the login page.
session_start();
if (!isset($_GET["key"]) && !isset($_GET["action"])
&& ($_GET['action'] != "activate")) {
    header("location:home.php");
}
include 'php/userloginfn.php';
?>

<?php
if (
    isset($_GET["key"]) && isset($_GET["action"])
    && ($_GET['action'] == "activate") && !isset($_POST["action"])
) {
    require_once "php/config.php";

    $token = $_GET["key"];
    $curDate = date("Y-m-d H:i:s");

    $query = $con->prepare("SELECT * FROM `temp_user` WHERE csrfToken=?");
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