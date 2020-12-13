<?php
/**
 * Obtaining the IP address
 *
 * @param null
 * 
 * @return String $ipAddr Returns an IP address  
 */

function getIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddr = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ipAddr = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddr;
}

/**
 * generate logs for directory traversal 
 *
 * @param null
 * 
 * @return null 
 */

function TraversalLogs()
{

        $logIp = getIpAddr();
        $url = $_SERVER['REQUEST_URI'];
        $logContent = "Unauthorised access on {$url}";
        require("config.php");
        $pQuery = $con->prepare("INSERT INTO `logs`(`log_type`, `log_content`, `log_ip`, `log_time`) VALUES (2,?,?,CURRENT_TIMESTAMP)"); //Prepared statement
        $pQuery->bind_param('ss', $logContent, $logIp);
        $pQuery->execute();

}

http_response_code(404);
?>


