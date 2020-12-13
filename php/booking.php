
<?php 
session_start();
session_regenerate_id(); //regenerate new session id
// To check if session is started.
if(isset($_SESSION["username"]))
{
    if(time()-$_SESSION["login_time_stamp"] >600)
    {
        session_unset();
        session_destroy();
        header("Location:../home.php");
    }
}
else
{
    header("Location:../home.php");
}
?> 

<html>
<head>

 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        <?php include '../css/styles.css'; ?>
        <?php include '../css/navbar.css'; ?>
        <?php include '../css/login.css'; ?>
        <?php include '../css/booking.css'; ?>

       
    </style>
    <script type="text/javascript" src="js/navbar.js"></script>
    <script type="text/javascript" src="js/userlogin.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="js/w3.js"></script>
    
</head>


<body>

 <nav>
        <div class="nav-links" id="tabnav">
            <li><a id="homeTab" href="home.php">Home</a></li>
            <li><a id="browseTab" href="browse.php">Browse</a></li>
            <li><a id="searchTab" href="search.php">Search</a></li>
            <li><a id="aboutTab" href="about.php">About</a></li>
        </div>

        <div class="logo" id="logo">
            <a href="home.php">
                <div class="logoIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 35 40">
                        <path d="M37.08,5.67a5.06,5.06,0,0,1-1.95,4.06,6.45,6.45,0,0,1-4.31,1.54,6.51,6.51,0,0,1-4.31-1.54,5.09,5.09,0,0,1-1.92-4.06A6.33,6.33,0,0,1,24.82,4H24.3Q18.66,4,14.18,9.14A15.82,15.82,0,0,0,9.84,19.78a8.32,8.32,0,0,0,3.59,7.29,13.91,13.91,0,0,0,8.13,2.16L25.92,17h8.74q-1.92,5.55-5.81,16.62Q27,38.88,20,38.88c-.54,0-1.17,0-1.87,0L20.27,33Q12.13,33,7,30.61,0,27.37,0,20.2a15.79,15.79,0,0,1,2.46-8.11,23.48,23.48,0,0,1,9.94-9A29.22,29.22,0,0,1,25.59,0h5.23a6.3,6.3,0,0,1,4.29,1.62A5.13,5.13,0,0,1,37.08,5.67Z" />
                        </g>
                        </g></svg>
                    </svg>
                </div>
                <div class="logoText">
                    Grabify
                </div>
            </a>
        </div>

        <div id="loginContainer" class="loginContainer">
            <div id="loginbtncontainer" class="loginbtncontainer" style="display: block;" onclick="shloginmodel()">
                <button id="login-btn" class="login-btn">
                    <div class="login-txt">
                        LOGIN
                    </div>
                </button>
            </div>

            <div id="loginModalContainer" class="loginModalContainer" style="display: none;">
                <div id="login-modal" class="login-modal animate">
                    <form action="#" method="post" class="login">
                        <h1>LOGIN</h1>
                        <div class="space"></div>
                        <hr />
                        <div class="space"></div>
                        <input type="text" id="usernamebox" name="username" placeholder="Username" required>
                        <input type="password" id="passwordbox" name="passwd" placeholder="Password" required>
                        <div id="loginerrormsg" class="warningtext" style="display: none;">Incorrect username or password. Please try again.</div>
                        <input type="checkbox" class="usercheckbox" id="usercheckbox" name="rmbMe">
                        <label for="usercheckbox" class="staylogged">Stay logged in</label>
                        <div class="bigspace"></div>
                        <div class="bigspace"></div>
                        <input type="submit" name="login" value="LOGIN">
                    </form>

                    <div>
                        <a id="forgotpsw" class="psw">Forgot
                            password?</a>
                        <div class="space"></div>
                        <p class="signup">New user?<a class="signuplink" onclick="shloginmodel(), shsignupmodal()">
                                Sign up here.</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="userbtncontainer" class="userbtncontainer" style="display: none;">
            <div class="btncontainer">
                <div class="userbtn">
                    <div id="usergreet" class="userwelcome"></div>
                </div>
            </div>
            <div class="userdropdown">
                <a href="profile.php">Profile</a>
                <a href="listReview.php">My reviews</a>
                <a href="favourites.php">Favourites</a>
                <a href="#" name="logout">Logout</a>
            </div>
        </div>
    </nav>

    <div id="passwdResetModel" class="fpswmodal animate" style="display: none;">
        <form class="fpsemail">
            <h1>Enter your username to reset password</h1>
            <div class="space"></div>
            <hr />
            <div class="space"></div>
            <input type="text" name="" placeholder="Username">
            <div id="resetinfotext" class="warningtext" style="display: none;">No user found</div>
            <input id="resetpwname" type="button" name="" value="SUBMIT">
        </form>
    </div>

    <div id="userSignupContainer" class="userSignupContainer" style="display: none;">
        <div id="signupmodal" class="signupmodal animate">
            <form action="#" method="post" class="signup">
                <h1>SIGN UP</h1>
                <div class="space"></div>
                <hr />
                <div class="space"></div>

                <input id="usernamesignupbox" type="text" name="username" placeholder="Username" onkeypress="usernameFilter()" required>
                <p id="invalidUser" class="warningtext" style="display: none;">Username should only contain alphanumeric characters </p>

                <input id="namesignupbox" type="text" name="name" placeholder="Name" onkeypress="nameFilter()" required>
                <p id="invalidName" class="warningtext" style="display: none;">Name should only contain alphabets.</p>

                <input id="mobilenosignupbox" type="text" name="mobileNo" placeholder="Mobile Number" onkeypress="mobilenoFilter()" required>
                <p id="invalidNo" class="warningtext" style="display: none;">Invalid Phone Number. </p>

                <input id="emailsignupbox" type="email" name="email" placeholder="Email" onkeypress="emailFilter()" required>
                <p id="invalidEmail" class="warningtext" style="display: none;">Invalid email. </p>

                <input id="addrsignupbox" type="text" name="address" placeholder="Address e.g. 123 Pine St" onkeypress="addrFilter()" required>
                <p id="invalidAddr" class="warningtext" style="display: none;">Invalid Address </p>

                <input id="tpwsignupbox" type="password" name="passwd" placeholder="Password" onkeypress="tpwFilter()" required>
                <input id="pwsignupbox" type="password" name="cfmpasswd" placeholder="Confirm password" onkeypress="pwFilter()" required>
                <input id='parseflag' type='hidden' name='flag'>
                <ul>
                    <li id="passLengError" class="warningtext" style="display: none;">Password must be at least 8 characters long</li>
                    <li id="noSpecialCharacter" class="warningtext" style="display: none;">Password must contain at least 1 special character</li>
                    <li id="noNumber" class="warningtext" style="display: none;">Password must contain at least a number</li>
                    <li id="noAlphabets" class="warningtext" style="display: none;">Password must contain at least an uppercase and a lowercase letter</li>
                </ul>
                <div class="space"></div>
                <div id="warninginfotext" class="warningtext" style="display: none;">Please enter all the information </div>
                <div id="warningpwtext" class="warningtext" style="display: none;"> Passwords do not match </div>
                <div id="emailerrormsg" class="warningtext" style="display: none"> Invalid email address</div>
                <div id="warningusernametext" class="warningtext" style="display: none;">This username is already taken</div>

                <input type="submit" name="signUp" value="SUBMIT" onclick="usersignup()">
            </form>
        </div>
    </div>

    <!--  <div id="confirmmodal" class="confirmmodal animate" style="display: none;">
        <form class="confirmtxt">
            <h1>Sign up success</h1>
            <div class="space"></div>
            <hr />
            <div class="bigspace"></div>
            <input type="button" name="" value="OK" onclick="location.reload();">
        </form>
    </div> -->

    <div id="resetconfirmmodal" class="confirmmodal animate" style="display: none;">
        <form class="confirmtxt">
            <h1 id="resettext"></h1>
            <div class="space"></div>
            <hr />
            <div class="bigspace"></div>
            <input type="button" name="" value="OK" onclick="location.reload();">
        </form>
    </div>

    <div id="navSpace" class="navSpace"></div>

    <!-- NAVBAR -->


   
<?php 

include 'config.php';
$username=$_SESSION["usename"];
$pQuery="SELECT booking.booking_id, booking.start_time, booking.end_time, product.name FROM (( booking LEFT JOIN product ON booking.product_product_id = product.product_id ) LEFT JOIN users ON booking.users_user_id=users.user_id ) WHERE users.username='$username' GROUP BY booking.booking_id" ;
$pQuery = $con->prepare($pQuery); //Prepared statement
$result=$pQuery->execute(); //execute the prepared statement
$result=$pQuery->get_result(); //store the result of the query from prepared statement
if(!$result) {
    die("Connection failed<br> ");
}
else {
    
}
$nrows=$result->num_rows; //store the number of rows from the results

if ($nrows>0) {
    echo "<h1 align='center'>Bookings</h1>";
    echo "<table>"; //Draw the table header
    echo "<table align='center'  width=50%>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Start Time</th>";
    echo "<th>End Time</th>";
    echo "<th>User</th>";
    echo "<th>Product</th>";
    echo "</tr>";
    while ($row=$result->fetch_assoc()) { //fields that will be filled with the details taken from sql db
        echo "<tr>";
        echo "<td>";
        echo $row['booking_id']; //defined in the db
        echo "</td>";
        echo "<td>";
        echo $row['start_time'];
        echo "</td>";
        echo "<td>";
        echo $row['end_time'];
        echo "</td>";
        echo "<td>";
        echo $username;
        echo "</td>";
        echo "<td>";
        echo $row['product_product_id'];
        echo "</td>";
        echo "<td>";
        echo "<a href='editbooking.php?Submit=GetUpdate&booking_id=".$row['booking_id']."'><button>Edit</button></a>"; //link to editbooking.php
        echo "</td>";
        echo "<td>";
        echo "<a href='deletebooking.php?Submit=Delete&booking_id=".$row['booking_id']."'><button>Delete</button></a>"; //link to deletebooking.php delete function
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}


$con->close(); //close the connecti

?>


</body>
</html>
