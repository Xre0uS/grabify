<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['function'])) {
    if (limitRequest($response)) {
        echo $response;
    } else {
        require("confignoecho.php");
        if ($_POST['function'] == 'authenticate') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $pQuery = $con->prepare("SELECT username, password, role FROM admin where username = ?"); //Prepared statement
            $pQuery->bind_param('s', $username);
            $result = $pQuery->execute(); //execute the prepared statement
            $result = $pQuery->get_result(); //store the result of the query from prepared statement
            $creds = $result->fetch_assoc();


            if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
                echo json_encode([
                    'status' => 0,
                ]);
            } else if (!isset($creds['password'])) {
                echo json_encode([
                    'status' => 0,
                ]);
            } else {
                if (password_verify($password, $creds['password'])) {
                    login($creds['role'], $creds['username'], $response);
                    echo $response;
                } else {
                    echo json_encode([
                        'status' => 0,
                    ]);
                }
            }
        } else if ($_POST['function'] == 'logout') {
            logout($redirect);
            echo $redirect;
        } else if ($_POST['function'] == 'checkLoggedIn') {
            checkLoggedIn($response);
            echo $response;
        }
    }
} else {
    http_response_code(403);
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


function login($role, $username, &$response)
{
    
    $logIp = $_SERVER['REMOTE_ADDR'];
    $logType = 0;
    $logContent = "User {$username} logged in";
    require("confignoecho.php");
    $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (?,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
    $pQuery->bind_param('iss', $logType, $logContent, $logIp);
    $pQuery->execute();

    session_regenerate_id();
    $_SESSION["aLoginStatus"] = true;
    $_SESSION["aUsername"] = $username;
    $_SESSION["aRole"] = $role;
    $_SESSION["aTimeout"] = time();
    if ($role == 0) {
        return $response = json_encode([
            'status' => 1,
            'username' => $username,
            'redirect' => "https://localhost/grabify/admin.php?master"
        ]);
    } else if ($role == 1) {
        return $response = json_encode([
            'status' => 1,
            'username' => $username,
            'redirect' => "https://localhost/grabify/admin.php?business"
        ]);
    } else if ($role == 2) {
        return $response = json_encode([
            'status' => 1,
            'username' => $username,
            'redirect' => "https://localhost/grabify/admin.php?user"
        ]);
    }
    return $response;
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
    } else if (isset($_SESSION["aLoginStatus"])) {
        $response = json_encode([
            'status' => 1,
            'loginStatus' => $_SESSION['aLoginStatus'],
            'username' => $_SESSION['aUsername'],
            'role' => $_SESSION['aRole']
        ]);
        return $response;
    } else {
        $response = json_encode([
            'status' => 0
        ]);
        return $response;
    }
}
