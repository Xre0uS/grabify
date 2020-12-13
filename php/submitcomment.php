<?php include 'userloginfn.php'; ?>
<?php
require('config.php');
if(isset($_SESSION["username"]))
{
	$prodID = $_POST['prodID'];
	$busID = $_POST['busID'];
	$rating = $_POST['rating'];
	$content = $_POST['content'];
	$username = $_SESSION['username'];
	$stmt=$con->prepare("SELECT user_id FROM users WHERE username = ?");//Get product data from database
	$stmt->bind_param("i", $username);
    $res=$stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userID); //Bind the data from database
	
	$ratingpattern = "/^[a-zA-Z0-9\s]*$/";
	if (!preg_match($contentpattern, $rating)){
    $content = preg_replace('/[^1-5]/', '5', $rating);} 

	$contentpattern = "/^[a-zA-Z0-9\s]*$/";
	if (!preg_match($contentpattern, $content)){
    $content = preg_replace('/[^A-Za-z0-9\-\s\.\,]/', '', $content);} 

echo"<form action='addcomment.php' method='POST'>
	<input type='hidden' value='".$userID."' name='userID'>
	<input type='hidden' value='".$prodID."' name='prodID'>
	<input type='hidden' value='".$busID."' name='busID'>
	<input type='hidden' value='".$rating."' name='rating'>
	<input type='hidden' value='".$content."' name='content'>
	<input type='submit' name='submit' value='Confirm upload?'>
	</form>";
    if(time()-$_SESSION["login_time_stamp"] >600)
    {
        session_unset();
        session_destroy();
        header("Location:../home.php");
    }
}
else
{
    header("Location:../home..php");
}
	
?>
