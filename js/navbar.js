var response = "";
var user_array = [];
var ueser_array_reset = [];

function checkActive() {
    if (window.location.href.includes("home")) {
        document.getElementById("homeTab").className = ("active");
    }
    else if (window.location.href.includes("browse.php")) {
        document.getElementById("browseTab").className = ("active");
    }
    else if (window.location.href.includes("search.php")) {
        document.getElementById("searchTab").className = ("active");
    }
    else if (window.location.href.includes("about.php")) {
        document.getElementById("aboutTab").className = ("active");
    }
}

function checkLogin() {
    if (window.location.href.includes("admin")) {
        adminLogin();
    }
    else if (window.location.href.includes("bis")) {
        businessLogin();
    }
    else {
        userLogin();
    }
}

function userLogin() {
    $(document).ready(function () {
        $("#loginBtnContainer").load('php/userloginfn.php');
    });
}

function adminLogin() {
    $(document).ready(function () {
        $("#loginBtnContainer").load('php/adminloginfn.php');
    });
}

function businessLogin() {
    $(document).ready(function () {
        $("#loginBtnContainer").load('php/bisloginfn.php');
    });
}

/*
function verifyuser() {
    var usernameinput = document.getElementById("usernamebox").value;
    var passowrdinput = document.getElementById("passwordbox").value;

    var credentials = new Object();
    credentials.username = usernameinput;
    credentials.user_password = passowrdinput;

    var login = new XMLHttpRequest();
    login.open("POST", "/user/login", true);
    login.setRequestHeader("Content-Type", "application/json");

    login.onload = function () {
        response = JSON.parse(login.responseText);

        if (response.message == "1") {
            checkuser(usernameinput);
        }

        else if (response.message == "2") {
            document.getElementById("wronguser").style.display = "none";
            document.getElementById("wrongpassword").style.display = "block";
        }
        else {
            document.getElementById("wrongpassword").style.display = "none";
            document.getElementById("wronguser").style.display = "block";
        }
    }
    login.send(JSON.stringify(credentials));
} */