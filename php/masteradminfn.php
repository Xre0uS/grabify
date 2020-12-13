<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['function'])) {
    echo "hi";
    if (limitRequest($response)) {
        echo $response;
    } else if (checkLoggedIn($response)) {
        echo $response;
    } else {
        if ($_POST['function'] == 'fillMasterTable') {
            require("confignoecho.php");
            $pQuery = $con->prepare("SELECT username, role FROM admin WHERE role = 1 OR role = 2"); //Prepared statement
            $result = $pQuery->execute(); //execute the prepared statement
            $result = $pQuery->get_result(); //store the result of the query from prepared statement
            $rows = array();
            echo "hi";
            while ($r = $result->fetch_assoc()) {
                $rows[] = $r;
            }
            echo json_encode($rows);
        } else if ($_POST['function'] == 'addAdmin') {
            addAdmin($response);
            echo $response;
        } else if ($_POST['function'] == 'delAdmin') {
            delAdmin($response);
            echo $response;
        } else if ($_POST['function'] == 'editAdmin') {
            editAdmin($response);
            echo $response;
        }
    }
} else {
    http_response_code(403);
}

function addAdmin(&$response)
{
    require("confignoecho.php");
    $username = $_POST['addUname'];
    $password = $_POST['addPassword'];
    $cPassword = $_POST['addCPassword'];
    $role = $_POST['addRole'];

    if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        $response == json_encode([
            'status' => 0,
            'err' => "Only letters and numbers allowed in username."
        ]);
        return $response;
    } else if ($password != $cPassword) {
        $response == json_encode([
            'status' => 0,
            'err' => "Passwords do not match."
        ]);
        return $response;
    } else if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/", $password)) {
        $response == json_encode([
            'status' => 0,
            'err' => "Try a stronger password"
        ]);
        return $response;
    } else {

        $logIp = $_SERVER['REMOTE_ADDR'];
        $url = $_SERVER['REQUEST_URI'];
        $aUname = $_SESSION['aUsername'];
        $logContent = "Admin added on {$url} by {$aUname}";
        require("confignoecho.php");
        $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (0,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
        $pQuery->bind_param('ss', $logContent, $logIp);
        $pQuery->execute();

        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = $con->prepare("INSERT INTO `admin`(`username`, `password`, `role`) VALUES (?,?,?)");
        $query->bind_param(
            'sss',
            $username,
            $password,
            $role,
        );
        if ($query->execute()) {  //execute query
            $response = json_encode([
                'status' => 1
            ]);
            return $response;
        } else {
            $response = json_encode([
                'status' => 0,
                'err' => "Username is taken."
            ]);
            return $response;
        }
    }
}

function delAdmin(&$response)
{
    require("confignoecho.php");
    $username = $_POST['dUname'];
    $query = $con->prepare("DELETE from admin where username = ?");
    $query->bind_param('s', $username);
    if ($query->execute()) {  //execute query

        $logIp = $_SERVER['REMOTE_ADDR'];
        $url = $_SERVER['REQUEST_URI'];
        $aUname = $_SESSION['aUsername'];
        $logContent = "Admin deleted on {$url} by {$aUname}";
        require("confignoecho.php");
        $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (0,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
        $pQuery->bind_param('ss', $logContent, $logIp);
        $pQuery->execute();

        $response = json_encode([
            'status' => 1
        ]);
        return $response;
    } else {
        $response = json_encode([
            'status' => 0
        ]);
        return $response;
    }
}

function editAdmin(&$response)
{
    require("confignoecho.php");
    $oldUsername = $_POST['oldUname'];
    $eUsername = $_POST['editUname'];
    $oldPassword = $_POST['eOldPassword'];
    $password = $_POST['editPassword'];
    $cPassword = $_POST['editCPassword'];
    $role = $_POST['editRole'];

    if (!preg_match("/^[a-zA-Z0-9]+$/", $eUsername)) {
        $response == json_encode([
            'status' => 0,
            'err' => "Only letters and numbers allowed in username."
        ]);
        return $response;
    } else if ($password != $cPassword) {
        $response == json_encode([
            'status' => 0,
            'err' => "Passwords do not match."
        ]);
        return $response;
    } else if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/", $password)) {
        $response == json_encode([
            'status' => 0,
            'err' => "Try a stronger password"
        ]);
        return $response;
    } else {
        $pQuery = $con->prepare("SELECT username, password, role FROM admin where username = ?"); //Prepared statement
        $pQuery->bind_param('s', $oldUsername);
        $result = $pQuery->execute(); //execute the prepared statement
        $result = $pQuery->get_result(); //store the result of the query from prepared statement
        $creds = $result->fetch_assoc();

        if (password_verify($oldPassword, $creds['password'])) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = $con->prepare("UPDATE admin SET username=?, password=?, role=? WHERE username=?");
            $query->bind_param(
                'ssis',
                $eUsername,
                $password,
                $role,
                $oldUsername
            ); //bind the parameters

            if ($query->execute()) {  //execute query

                $logIp = $_SERVER['REMOTE_ADDR'];
                $url = $_SERVER['REQUEST_URI'];
                $aUname = $_SESSION['aUsername'];
                $logContent = "Admin edited on {$url} by {$aUname}";
                require("confignoecho.php");
                $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (0,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
                $pQuery->bind_param('ss', $logContent, $logIp);
                $pQuery->execute();

                $response = json_encode([
                    'status' => 1
                ]);
                return $response;
            } else {
                $response = json_encode([
                    'status' => 0,
                    'err' => "Username is taken."
                ]);
                return $response;
            }
        } else {
            echo json_encode([
                'status' => 0,
                'err' => "Wrong password."
            ]);
        }
    }
}

function limitRequest(&$response)
{
    // set the variables that define the limits:
    $min_time = 60; // seconds
    $max_requests = 20;
    // Create requests array in session scope if it does not yet exist
    if (!isset($_SESSION['requests'])) {
        $_SESSION['requests'] = [];
    }
    // Create a shortcut variable for this array
    $requests = &$_SESSION['requests'];
    $countRecent = 0;
    foreach ($requests as $request) {
        // See if the current request was made before
        // Count (only) new requests made in last minute
        if ($request["time"] >= time() - $min_time) {
            $countRecent++;
        }
    }
    // Check if limit is crossed.
    // NB: Refused requests are not added to the log.
    if ($countRecent >= $max_requests) {
        $response = json_encode([
            'status' => 3,
            'err' => "Too many requests. Actions disabled for 30 seconds.",
            'redirect' => "https://localhost/grabify/admin.php"
        ]);

        $logIp = $_SERVER['REMOTE_ADDR'];
        $url = $_SERVER['REQUEST_URI'];
        $logContent = "Request overload on {$url}";
        require("confignoecho.php");
        $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (0,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
        $pQuery->bind_param('ss', $logContent, $logIp);
        $pQuery->execute();

        session_unset();
        session_destroy();
        return $response;
        sleep(30);
    }
    // Add current request to the log.
    $requests[] = ["time" => time()];
}

function logout(&$response)
{
    session_unset();
    session_destroy();
    $response = json_encode([
        'redirect' => "https://localhost/grabify/admin.php"
    ]);
    return $response;
}

function checkTimeout(&$response)
{
    if (isset($_SESSION["aTimeout"])) {
        $inactive = 600;
        $sessionTTL = time() - $_SESSION["aTimeout"];
        if ($sessionTTL > $inactive) {
            logout($response);
            $response = json_encode([
                'status' => 2,
                'err' => "Session timed out.",
                'redirect' => "https://localhost/grabify/admin.php"
            ]);
            return $response;
            return true;
        }
    }
}

function checkLoggedIn(&$response)
{
    if (checkTimeout($response)) {
        return $response;
    } else if (!isset($_SESSION["aLoginStatus"])) {
        $response = json_encode([
            'status' => 0
        ]);
        return $response;
    } else if ($_SESSION['aRole'] != 0) {
        $response = json_encode([
            'status' => 0
        ]);
        return $response;
    }
}
