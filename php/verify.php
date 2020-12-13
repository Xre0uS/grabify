<?php

/**
 * Regex is used validate each fields to ensure that the information entered by the user is indeed 
 * what it is meant to be 
 *
 * @param String $field retriving the name of the field and validate it against user input
 * 
 * @return Boolean If the user input fits the regex pattern, it will return 1 else, it will return 0.
 * @return integer An integer will be returned after password vaildation 
 * @return integer -1 will be returned if there is an error in the code 
 */

function checkField(String $field)
{
    switch ($field) {
        case 'username':
            return (preg_match('/[a-zA-Z0-9]+/', $_POST['username']));
            break;
        case 'name':
            return (preg_match('/[a-zA-Z\s]+/', $_POST['name']));
            break;
        case 'mobileNo':
            return (preg_match('/^[89][0-9]{7}$/', $_POST['mobileNo']));
            break;
        case 'email':
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                return 1;
                break;
            } else {
                return 0;
                break;
            }
            break;
        case 'address':
            return (preg_match('/^\d+\s[A-Za-z]+\s[A-Za-z]+/', $_POST['address']));
            break;
        case 'passwd':
            return (preg_match('/^[!@#$@?0-9A-Za-z]{8,}$/', $_POST['passwd']) * 10000 +
                preg_match('/^.*[!@#$@?].*$/', $_POST['passwd']) * 1000 +
                preg_match('/^.*[0-9].*$/', $_POST['passwd']) * 100 +
                preg_match('/^.*[A-Z].*$/', $_POST['passwd']) * 10 +
                preg_match('/^.*[a-z].*$/', $_POST['passwd']));
            break;
        case 'cfmpasswd':
            return ($_POST['passwd'] === $_POST['cfmpasswd']);
            break;
        default:
            return -1;
            break;
    }
}

/**
 * Checking if the username has been taken by another user 
 *
 * @param String $username Retriving the username and validate against the database
 * @param Object $conn      Retriving the connection instance made previously
 * 
 * @return Boolean If the username exist in the database, it will return 1 and display and error message
 * else, it will return 0.
 * 
 */
function checkUsername($username, $conn)
{
    $query = $conn->prepare("SELECT username FROM users WHERE username=?");
    $query->bind_param('s', $username);
    $result = $query->execute();
    $result = $query->get_result();

    if (!$result) {
        die("SELECT query failed<br> " . $conn->error);
    } else {
        echo "SELECT query successful<br>";
    }

    $nrows = $result->num_rows;

    if ($nrows > 0) {
        return 1;
    } else {

        $tquery = $conn->prepare("SELECT username FROM temp_user WHERE username=?");
        $tquery->bind_param('s', $username);
        $tresult = $tquery->execute();
        $tresult = $tquery->get_result();

        $rrows = $tresult->num_rows;
        if ($rrows > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}

/**
 * Checking if the user has been blocked in the database for mutiple failed login attempts  
 * Timeout session will also be checked and remove if it has been blocked for 2 minutes or more. 
 *
 * @param String $username  Retriving the username and validate against the database
 * @param Object $conn      Retriving the connection instance made previously
 * 
 * @return Boolean 
 * If the username still exist in the database after checking the timeout, it will return 1 and deny access 
 * else, it will return 0.
 * 
 */
function checkBlock($username, $conn)
{
    $query = $conn->prepare("SELECT * FROM block_user WHERE username=?");
    $query->bind_param('s', $username);
    $result = $query->execute();
    $result = $query->get_result();

    // if (!$result) {
    //     die("SELECT query failed<br> " . $conn->error);
    // } else {
    //     echo "SELECT query successful<br>";
    // }

    $nrows = $result->num_rows;

    if ($nrows > 0) {
        $row = $result->fetch_assoc();

        $timeBlock = strtotime($row['blockTime']);
        $removeFromDB = strtotime($row['tryAgain']);
        $diff = $removeFromDB - $timeBlock;

        if ($diff >= 120) {
            $query = $conn->prepare("Delete FROM `block_user` WHERE username=?");

            $query->bind_param('s', $username);

            if ($query->execute()) {
                return 0;
            } else {
                echo "Unable to Delete.";
            }
        } else {
            return 1;
        }

    } else {
        return 0;
    }
}


/**
 * Authenticate users based on the username and password supplied by the user 
 * 
 * @param String $username Retriving the username and validate against the database
 * @param String $passwd   Retriving the password and validate against the database
 * @param Object $conn      Retriving the connection instance made previously
 * 
 * @return Boolean If the credentials supplied by the user exist in the database, 
 * it will return 1 and display and error message else, it will return 0.
 * 
 */
function auth($username, $passwd, $conn)
{

    $query = $conn->prepare("SELECT password FROM users WHERE username=?");
    $query->bind_param('s', $username);
    $result = $query->execute();
    $result = $query->get_result();

    // if (!$result) {
    //     die("SELECT query failed<br> " . $conn->error);
    // } else {
    //     echo "SELECT query successful<br>";
    // }

    $nrows = $result->num_rows;

    if ($nrows > 0) {
        $row = $result->fetch_assoc();
        $hashedpass = $row['password'];
    } else {
        // echo "Username or Password is incorrect. <br>";

        $query = $conn->prepare("SELECT password FROM temp_user WHERE username=?");
        $query->bind_param('s', $username);
        $result = $query->execute();
        $result = $query->get_result();

        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $hashedpass = $row['password'];
        } else {
            return 0;
        }
    }

    $verifypass = password_verify($passwd, $hashedpass);
    if ($verifypass == 1) {
        // echo "true";
        return 1;
    } else {
        // echo "false";
        // echo "Username or Password is incorrect. <br>";
        return 0;
    }
}

/**
 * Check if the user has registered to the website 
 *
 * @param String $email Retriving the email and validate against the database
 * @param Object $conn      Retriving the connection instance made previously
 * 
 * @return Boolean If the email exist in the database, it will return an error message
 * else, it will return the usename.
 * 
 */
function checkEmail($username, $email, $conn)
{
    $query = $conn->prepare("SELECT username FROM users WHERE email=? AND username=?");
    $query->bind_param('ss', $email, $username);
    $result = $query->execute();
    $result = $query->get_result();

    if (!$result) {
        die("SELECT query failed<br> " . $conn->error);
    } else {
        echo "SELECT query successful<br>";
    }

    $nrows = $result->num_rows;

    if ($nrows > 0) {
        $row = $result->fetch_assoc();
        return $row['username'];
    } else {
        return "Please Verify your email address again.";
    }
}

/**
 * Retrieve email to send email to users  
 *
 * @param String $username Retriving the username to obtain the email address
 * @param Object $conn      Retriving the connection instance made previously
 * 
 * @return String 
 * Based on the username provided, the email will be retrieve and used to send emails to users
 * 
 */
function getEmail($username, $conn)
{
    $query = $conn->prepare("SELECT email FROM users WHERE username=?");
    $query->bind_param('s', $username);
    $result = $query->execute();
    $result = $query->get_result();

    // if (!$result) {
    //     die("SELECT query failed<br> " . $conn->error);
    // } else {
    //     echo "SELECT query successful<br>";
    // }

    $nrows = $result->num_rows;

    if ($nrows > 0) {
        $row = $result->fetch_assoc();
        return $row['email'];
    } else {
        return "User does not exist";
    }
}

http_response_code(404);
?>