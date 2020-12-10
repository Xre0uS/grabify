<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['function'])) {
    if (limitRequest($response)) {
        echo $response;
    } else if (checkLoggedIn($response)) {
        echo $response;
    } else {
        if ($_POST['function'] == 'fillLogTable') {
            if ($_SESSION['aRole'] == 0) {
                require("confignoecho.php");
                $pQuery = $con->prepare("SELECT log_content, log_ip, log_time FROM logs WHERE log_type = 0"); //Prepared statement
                $result = $pQuery->execute(); //execute the prepared statement
                $result = $pQuery->get_result(); //store the result of the query from prepared statement
                $rows = array();
                while ($r = $result->fetch_assoc()) {
                    $rows[] = $r;
                }
                echo json_encode($rows);
            } else if ($_SESSION['aRole'] == 1) {
                require("confignoecho.php");
                $pQuery = $con->prepare("SELECT log_content, log_ip, log_time FROM logs WHERE log_type = 1"); //Prepared statement
                $result = $pQuery->execute(); //execute the prepared statement
                $result = $pQuery->get_result(); //store the result of the query from prepared statement
                $rows = array();
                while ($r = $result->fetch_assoc()) {
                    $rows[] = $r;
                }
                echo json_encode($rows);
            } else if ($_SESSION['aRole'] == 2) {
                require("confignoecho.php");
                $pQuery = $con->prepare("SELECT log_content, log_ip, log_time FROM logs WHERE log_type = 2"); //Prepared statement
                $result = $pQuery->execute(); //execute the prepared statement
                $result = $pQuery->get_result(); //store the result of the query from prepared statement
                $rows = array();
                while ($r = $result->fetch_assoc()) {
                    $rows[] = $r;
                }
                echo json_encode($rows);
            }
        }
    }
} else {
    http_response_code(403);
}

function limitRequest(&$response)
{
    // set the variables that define the limits:
    $min_time = 60; // seconds
    $max_requests = 10;
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
            'redirect' => "http://localhost/grabify/admin.php"
        ]);

        $logIp = $_SERVER['REMOTE_ADDR'];
        $logContent = "Request overload on adminlogs.php";
        require("confignoecho.php");
        $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (0,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
        $pQuery->bind_param('ss', $logContent, $logIp);
        $pQuery->execute();

        return $response;
        session_unset();
        session_destroy();
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
        'redirect' => "http://localhost/grabify/admin.php"
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
                'redirect' => "http://localhost/grabify/admin.php"
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
            'status' => 0,
            'err' => 'Unauthorised access!',
            'redirect' => "http://localhost/grabify/admin.php"
        ]);

        $logIp = $_SERVER['REMOTE_ADDR'];
        $url = $_SERVER['REQUEST_URI'];
        $logContent = "Unauthorised access on {$url}";
        require("confignoecho.php");
        $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (0,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
        $pQuery->bind_param('ss', $logContent, $logIp);
        $pQuery->execute();
        return $response;
    }
}
