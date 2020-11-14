function checkLoggedin() {
    //check if bis is logged in
    if (sessionStorage.getItem("loginstatus") == "true") {
        companyLogin();
    }
    else {
        shloginbtn();
    }
}

function companyLogin() {
    //get logged in username and display in welcome text, should be done with $_session in php, remove when necessary
    if (localStorage.getItem("loginstatus") == "true" || sessionStorage.getItem("loginstatus") == "true") {
        shuserbtn();
        if (sessionStorage.getItem("loggedusername") == "null" || sessionStorage.getItem("loggedusername") == "" || sessionStorage.getItem("loggedusername") == null) {
            document.getElementById("usergreet").innerHTML = "Welcome, " + localStorage.getItem("loggedusername");
        }
        else {
            document.getElementById("usergreet").innerHTML = "Welcome, " + sessionStorage.getItem("loggedusername");
        }
    }
    else {
        shloginbtn();
    }
}

function loginAdmin() {
    //function to login in user and save username in storage, should be done with $_session in php, remove when necessary
    sessionStorage.setItem("loginstatus", true);
    sessionStorage.setItem("loggedinid", "");
    sessionStorage.setItem("loggedusername", "Admin");
    location.reload();
    /* var userid = user_array[0].user_id;
    var username = user_array[0].username;

    var update = new XMLHttpRequest();
    update.open("GET", "/user/activate/" + userid, true);
    update.setRequestHeader("Content-Type", "application/json");
    update.send();

    if (document.getElementById("usercheckbox").checked == true) {
        localStorage.setItem("loginstatus", true);
        localStorage.setItem("loggedinid", userid);
        localStorage.setItem("loggedusername", username);
    }

    else {
        sessionStorage.setItem("loginstatus", true);
        sessionStorage.setItem("loggedinid", userid);
        sessionStorage.setItem("loggedusername", username);
    }
    location.reload(); */
}

function logout() {
    //logout the user and remove username in storage, should be done with $_session in php, remove when necessary
    localStorage.setItem("loginstatus", false);
    localStorage.setItem("loggedinid", "");
    localStorage.setItem("loggedusername", "");
    sessionStorage.setItem("loginstatus", false);
    sessionStorage.setItem("loggedinid", "");
    sessionStorage.setItem("loggedusername", "");
    location.reload();
}



//functions to show/hide modals
var modal = document.getElementById('loginModalContainer');
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function shloginmodal() {
    var x = document.getElementById("loginModalContainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function shloginbtn() {
    var x = document.getElementById("loginBtn");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function shfpswmodal() {
    var x = document.getElementById("fpswmodal");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function shsignupmodal() {
    var x = document.getElementById("userSignupContainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function shuserbtn() {
    var x = document.getElementById("userbtncontainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}