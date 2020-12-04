<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        <?php include 'css/styles.css'; ?><?php include 'css/navbar.css'; ?><?php include 'css/login.css'; ?>
    </style>
    <script type="text/javascript" src="js/navbar.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/w3.js"></script>
</head>

<body onload="checkActive(), checkLogin()">
    <nav id="navbar">
        <div class="nav-links" id="tabnav">
            <li><a id="homeTab" href="home.php">Home</a></li>
            <li><a id="browseTab" href="products.php">Browse</a></li>
            <li><a id="searchTab" href="search.php">Search</a></li>
            <li><a id="aboutTab" href="about.php">About</a></li>
        </div>

        <div class="logo" id="logo" onclick="logoAction()">
            <div class="logoIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 35 40">
                    <path d="M37.08,5.67a5.06,5.06,0,0,1-1.95,4.06,6.45,6.45,0,0,1-4.31,1.54,6.51,6.51,0,0,1-4.31-1.54,5.09,5.09,0,0,1-1.92-4.06A6.33,6.33,0,0,1,24.82,4H24.3Q18.66,4,14.18,9.14A15.82,15.82,0,0,0,9.84,19.78a8.32,8.32,0,0,0,3.59,7.29,13.91,13.91,0,0,0,8.13,2.16L25.92,17h8.74q-1.92,5.55-5.81,16.62Q27,38.88,20,38.88c-.54,0-1.17,0-1.87,0L20.27,33Q12.13,33,7,30.61,0,27.37,0,20.2a15.79,15.79,0,0,1,2.46-8.11,23.48,23.48,0,0,1,9.94-9A29.22,29.22,0,0,1,25.59,0h5.23a6.3,6.3,0,0,1,4.29,1.62A5.13,5.13,0,0,1,37.08,5.67Z" />
                </svg>
            </div>
            <div id="logoText" class="logoText">
                Grabify
            </div>
            </a>
        </div>

        <div class="loginBtnContainer" id="loginBtnContainer">

    </nav>

    <div id="navSpace" class="navSpace"></div>

    <!-- NAVBAR -->

</body>

<script>
    function staticReload() {
        location.reload();
    }
</script>