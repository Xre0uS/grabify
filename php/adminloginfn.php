<?php

if (isset($_POST['function'])) {
    require("config.php");
    if ($_POST['function'] == 'auth') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pQuery = $con->prepare("SELECT username, password FROM admin where username = ?"); //Prepared statement
        $pQuery->bind_param('s', $username);
        $result = $pQuery->execute(); //execute the prepared statement
        $result = $pQuery->get_result(); //store the result of the query from prepared statement
        $creds = $result->fetch_assoc();


        if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
            echo "Only numbers and letters are allowed in username.";
        } else if (!isset($creds['password'])) {
            echo "respond0";
        } else {
            if (password_verify("$password", $creds['password'])) {
                echo "respond1";
            } else {
                echo "respond0";
            }
        }
    }
} else {
    http_response_code(403);
}

?>