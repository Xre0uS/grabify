<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

/**
 * Used to send an email to recover password  
 * 
 * @param String $email    Retriving the user's email to send password recovery email 
 * @param String $username Retriving the username to address the user in the email 
 * @param String $token    Retriving the token to ensure that only the intended user is able to change their password 
 * 
 * @return Boolean If the email is sent successfully, it will return 1 else it will return 0.
 * 
 */
function sendMail($email, $username, $token)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "swapcsadm@gmail.com";
  $mail->Password   = "Verity@3802";

  $mail->IsHTML(true);
  $mail->AddAddress($email, $username);
  $mail->SetFrom("swapcsadm@gmail.com", "swapadmin");
  $mail->AddReplyTo("swapcsadm@gmail.com", "swapadmin");
  $mail->Subject = "Password Recovery - grabify.com";

  $content = '<p>Dear <strong>' . $username . ' </strong>,</p>';
  $content .= '<p>Please click on the following link to reset your password.</p>';
  $content .= '<p>-------------------------------------------------------------</p>';
  $content .= '<p><a href="http://localhost/grabify/new_password.php?key=' . $token . '&action=reset" target="_blank">
    http://localhost/grabify/new_password.php?key=' . $token . '&action=reset</a></p>';
  $content .= '<p>-------------------------------------------------------------</p>';
  $content .= '<p>Please be sure to copy the entire link into your browser.
    The link will expire after 1 day for security reason.</p>';
  $content .= '<p>If you did not request this forgotten password email, no action 
    is needed, your password will not be reset. However, you may want to log into 
    your account and change your security password as someone may have guessed it.</p>';
  $content .= '<p>Thanks,</p>';
  $content .= '<p>Grabify Team</p>';
  $body = $content;

  $mail->MsgHTML($body);

  if (!$mail->Send()) {
    var_dump($mail);
    return 0;
  } else {
    return 1;
  }
}


/**
 * Used to send an email to activate email   
 * 
 * @param String $email    Retriving the user's email to send password recovery email 
 * @param String $username Retriving the username to address the user in the email 
 * @param String $token    Retriving the token to ensure that only the intended user is able to change their password 
 * 
 * @return Boolean If the email is sent successfully, it will return 1 else it will return 0.
 * 
 */
function activateAccountMail($email, $username, $token)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "swapcsadm@gmail.com";
  $mail->Password   = "Verity@3802";

  $mail->IsHTML(true);
  $mail->AddAddress($email, $username);
  $mail->SetFrom("swapcsadm@gmail.com", "swapadmin");
  $mail->AddReplyTo("swapcsadm@gmail.com", "swapadmin");
  $mail->Subject = "Account Activation - grabify.com";

  $content = '<p>Dear <strong>' . $username . ' </strong>,</p>';
  $content .= '<p>Welcome to Grabify!</p><br>';
  $content .= '<p>Click on the link below to activate your Grabify account. <p>';
  $content .= '<p>-------------------------------------------------------------</p>';
  $content .= '<p><a href="http://localhost/grabify/activate_login.php?key=' . $token . '&action=activate" target="_blank">
  http://localhost/grabify/activate_login.php?key=' . $token . '&action=activate</a></p>';
  $content .= '<p>-------------------------------------------------------------</p>';
  $content .= '<p>Please be sure to copy the entire link into your browser.
  If you run into any problems, feel free to contact us at support@grabify.com</p>';
  $content .= '<p>Thanks,</p>';
  $content .= '<p>Grabify Team</p>';
  $body = $content;

  $mail->MsgHTML($body);

  if (!$mail->Send()) {
    var_dump($mail);
    return 0;
  } else {
    return 1;
  }
}


/**
 * Sending an email to inform user that their passwords or personal 
 * information has been changed or failed login attempts has been detected. 
 * 
 * @param String $email           Retriving the user's email to send password recovery email 
 * @param String $username        Retriving the username to address the user in the email 
 * @param Integer $infoChanged    
 * A value parsed to send emails to the user should the user information or password
 * has been changed where 
 * 0 represents password changed,
 * 1 represents user information has been changed and 
 * 2 represents failed login attempts 
 * 
 * @return Boolean If the email is sent successfully, it will return 1 else it will return 0.
 * 
 */
function infoUserMail($email, $username, $infoChanged)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "swapcsadm@gmail.com";
  $mail->Password   = "Verity@3802";

  $mail->IsHTML(true);
  $mail->AddAddress($email, $username);
  $mail->SetFrom("swapcsadm@gmail.com", "swapadmin");
  $mail->AddReplyTo("swapcsadm@gmail.com", "swapadmin");
  if ($infoChanged == 0) {
    $mail->Subject = "Your Password Has Been Updated - grabify.com";
  } else if ($infoChanged == 1) {
    $mail->Subject = "Your Profile Has Been Updated - grabify.com";
  } else if ($infoChanged == 2) {
    $mail->Subject = "Failed Login Attempts Detected - grabify.com";
  }

  $content = '<p>Hi <strong>' . $username . ' </strong>,</p>';

  if ($infoChanged == 0) {
    $content .= "<p>We have received your request to change your password and it's all set to go!";
  } else if ($infoChanged == 1) {
    $content .= "<p>We have received your request to update your profile and we are pleased to inform you that 
      we have updated it successfully!";
  } else if ($infoChanged == 2) {
    $content .= 'Sorry to hear you are having trouble logging into Grabify. <br> Please try again after 2 minutes.
    <br> Please reset your password if this action is not done by you. You may also clicked on forget password 
    to changed your password if you have forgotten your password. <p>';
    $content .= '<p>If you have any questions, feel free to contact our Customer Support team at help@grabify.com. </p>';
  }

  if ($infoChanged < 2) {
    $content .= '<p>If you did not request for this, please contact our Customer Support team at help@grabify.com.</p>';
  }

  $content .= '<p>Thanks,</p>';
  $content .= '<p>Grabify Team</p>';

  $body = $content;

  $mail->MsgHTML($body);

  if (!$mail->Send()) {
    var_dump($mail);
    return 0;
  } else {
    return 1;
  }
}

/**
 * Sending an email to inform user that someone has logged into their account
 * 
 * @param String $email           Retriving the user's email to send password recovery email 
 * @param String $username        Retriving the username to address the user in the email 
 * 
 * @return Boolean If the email is sent successfully, it will return 1 else it will return 0.
 * 
 */
function newLogin($email, $username)
{
  $currentTime = date("Y-m-d H:i:s", time());
  $userAgent = $_SERVER['HTTP_USER_AGENT'];

  if ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)){
    $browser = 'Internet Explorer';
  } else if (((strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== FALSE))){
    $browser = 'Safari';
  } else if (((strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 10.0') !== FALSE))){
    $browser = 'Chrome on Window';
  }
  

  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "swapcsadm@gmail.com";
  $mail->Password   = "Verity@3802";

  $mail->IsHTML(true);
  $mail->AddAddress($email, $username);
  $mail->SetFrom("swapcsadm@gmail.com", "swapadmin");
  $mail->AddReplyTo("swapcsadm@gmail.com", "swapadmin");
  $mail->Subject = "Your Account was accessed from a new device - grabify.com";


  $content = '<p>Hi <strong>' . $username . ' </strong>,</p>';
  $content .= '<p> We noticed an unusual login from a device or location you do not usually use. <p>';
  $content .= '<p>Was it really you?</p>';
  $content .= '<p>Time: '. $currentTime . '</p>';
  $content .= '<p>' .$browser.'</p><br>';
  $content .= '<p>If you did not request for this, you may want to log into your account and change your password as someone may have guessed it. </p>';
  $content .= '<p>If you have any questions, feel free to contact our Customer Support team at help@grabify.com. </p>';

  $content .= '<p>Thanks,</p>';
  $content .= '<p>Grabify Team</p>';

  $body = $content;

  $mail->MsgHTML($body);

  if (!$mail->Send()) {
    var_dump($mail);
    return 0;
  } else {
    return 1;
  }
}

/**
 * Sending an email to inform user that their account has been deleted or someone else has deleted their account 
 * 
 * @param String $email           Retriving the user's email to send password recovery email 
 * @param String $username        Retriving the username to address the user in the email 
 * @param String $token           Retriving the token to identify the user
 * 
 * @return Boolean If the email is sent successfully, it will return 1 else it will return 0.
 * 
 */
function deleteAccount($email, $username, $token)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "swapcsadm@gmail.com";
  $mail->Password   = "Verity@3802";

  $mail->IsHTML(true);
  $mail->AddAddress($email, $username);
  $mail->SetFrom("swapcsadm@gmail.com", "swapadmin");
  $mail->AddReplyTo("swapcsadm@gmail.com", "swapadmin");
  $mail->Subject = "Account Delete Confirmation - grabify.com";


  $content = '<p>Hi <strong>' . $username . ' </strong>,</p>';
  $content .= '<p> We have received a request to permanently delete your Grabify Account. </p>';
  $content .= '<p> Once deleted, you will not be able to make any purchase, write any review or add any items to your wishlist. 
  You will not be able to edit your reviews or access your wishllist. <p>';
  $content .= '<br><p>Ignore this email if you do not wish to delete your account. Your data will not be lost.</p> <br>';
  $content .= '<p>However, if you still wish to delete your account, click the link below.  </p> <br>';
  $content .= '<p>-------------------------------------------------------------</p>';
  $content .= '<p><a href="http://localhost/grabify/removeuser.php?username='.$username.'&key=' . $token . '&action=remove" target="_blank">
  http://localhost/grabify/removeuser.php?username='.$username.'&key=' . $token . '&action=remove</a></p>';
  $content .= '<p>-------------------------------------------------------------</p>';
  $content .= '<p>Please be sure to copy the entire link into your browser.
  If you run into any problems, feel free to contact us at support@grabify.com</p>';
  $content .= '<p>If you have any questions, feel free to contact our Customer Support team at help@grabify.com. </p>';
  $content .= '<br><p> Thank you for trying Grabify. </p>';

  $content .= '<p>Thanks,</p>';
  $content .= '<p>Grabify Team</p>';

  $body = $content;

  $mail->MsgHTML($body);

  if (!$mail->Send()) {
    var_dump($mail);
    return 0;
  } else {
    return 1;
  }
}

?>