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
        if ($_POST['function'] == 'fillUserTable') {
            require("confignoecho.php");
            $pQuery = $con->prepare("SELECT review.review_id, users.user_id, users.username, product.product_id, product.name, business.business_id, business.company_name, review.rating, review.content, review.timestamp FROM ( ( ( review LEFT JOIN product ON product.product_id = review.product_product_id ) LEFT JOIN business ON business.business_id = review.business_business_id ) LEFT JOIN users ON users.user_id = review.users_user_id ) GROUP BY review.review_id"); //Prepared statement
            $result = $pQuery->execute(); //execute the prepared statement
            $result = $pQuery->get_result(); //store the result of the query from prepared statement
            $rows = array();
            while ($r = $result->fetch_assoc()) {
                $rows[] = $r;
            }
            echo json_encode($rows);
        } else if ($_POST['function'] == 'delReview') {
            $id = $_POST['id'];
            require("confignoecho.php");
            $query = $con->prepare("DELETE from review WHERE review_id=?"); //Prepared statement
            $query->bind_param('i', $id); //bind the parameters
            if ($query->execute()) {  //execute query
                $response = json_encode([
                    'status' => 1
                ]);
                echo $response;
            } else {
                $response = json_encode([
                    'status' => 0,
                    'err' => "Error excuting query."
                ]);
                echo $response;
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
    } else if ($_SESSION['aRole'] != 2) {
        $response = json_encode([
            'status' => 0
        ]);
        return $response;
    }
}
