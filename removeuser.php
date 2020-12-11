<?php
include "php/lookup.php";
// Check if session is not registered, if it is not, the user will be redirected back to the login page.
session_start();

if (
    !isset($_GET["key"]) && !isset($_GET["action"])
    && ($_GET['action'] != "remove")
) {
    TraversalLogs();
    header("location:home.php");
}
?>

<?php
if (
    isset($_GET["key"]) && isset($_GET["action"])
    && ($_GET['action'] == "remove") && !isset($_POST["action"])
) {
    $username = $_GET['username'];
    echo $username;

    
    require "php/config.php";

    echo "hi";
    $query = $con->prepare("Delete FROM `users` WHERE username=?");

    $query->bind_param('s', $username);

    if ($query->execute()) {
        echo "Deleted.";
        $_SESSION['deleted'] = 1;
        header("location:home.php");
    } else {
        echo "Unable to Delete.";
        echo " <script> alert('Delete Failed'); </script>";
    }
}
?>

