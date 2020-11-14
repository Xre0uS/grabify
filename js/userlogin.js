function checkLoggedin() {
    //check if user is logged in
    if (sessionStorage.getItem("loginstatus") == "true") {
        userLogin();
    }
    else {
        shloginbtn();
    }
}

function usersignup() {
    //handles signup functions, check if all fields are filled and confirm password matches
    var usernamesignup = document.getElementById("usernamesignupbox").value;
    var namesignup = document.getElementById("namesignupbox").value;
    var emailsignup = document.getElementById("emailsignupbox").value;
    var numbersignup = document.getElementById("numbersignupbox").value;
    var addresssignup = document.getElementById("addresssignupbox").value;
    var tpwsignup = document.getElementById("tpwsignupbox").value;
    var pwsignup = document.getElementById("pwsignupbox").value;

    if (usernamesignup == "" || namesignup == "" || emailsignup == "" || numbersignup == "" || addresssignup == "" || tpwsignup == "" || pwsignup == "") {
        document.getElementById("warninginfotext").style.display = "block";
        document.getElementById("warningpwtext").style.display = "none";
    }

    else if (tpwsignup !== pwsignup) {
        document.getElementById("warninginfotext").style.display = "none";
        document.getElementById("warningpwtext").style.display = "block";
    }
    else {
        sessionStorage.setItem("loginstatus", true);
        sessionStorage.setItem("loggedinid", "1");
        sessionStorage.setItem("loggedusername", "User");
        location.reload();
        /* var usernameinput = document.getElementById("usernamesignupbox").value;

        var credentials = new Object();
        credentials.username = usernameinput;

        var login = new XMLHttpRequest();
        login.open("POST", "/user/login", true);
        login.setRequestHeader("Content-Type", "application/json");

        login.onload = function () {
            response = JSON.parse(login.responseText);

            if (response.message == "2") {
                document.getElementById("warningpwtext").style.display = "none";
                document.getElementById("wronguser").style.display = "none";
                document.getElementById("warningusernametext").style.display = "block";
            }
            else {
                var usersignup = new Object();
                usersignup.username = usernamesignup;
                usersignup.user_email = emailsignup;
                usersignup.user_number = numsignup;
                usersignup.user_address = adsignup;
                usersignup.user_password = pwsignup;
                usersignup.user_gender = gendersignup;

                var addUser = new XMLHttpRequest();
                addUser.open("POST", "/user", true);
                addUser.setRequestHeader("Content-Type", "application/json");
                addUser.send(JSON.stringify(usersignup));
                sessionStorage.setItem("loggedusername", usernamesignup);
                sessionStorage.setItem("loginstatus", true);
                shsignupmodal();
                document.getElementById("confirmmodal").style.display = "block"
            }
        }
        login.send(JSON.stringify(credentials)); */
    }
}

function userLogin() {
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

function loginUser() {
    //function to login in user and save username in storage, should be done with $_session in php, remove when necessary
    sessionStorage.setItem("loginstatus", true);
    sessionStorage.setItem("loggedinid", "");
    sessionStorage.setItem("loggedusername", "User");
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
    window.location.href = "home.php";
}

function resetpassword() {
    //not working, should be done in php
    resetname = document.getElementById("resetpwname").value;

    if (resetname == "") {
        document.getElementById("resetinfotext").style.display = "block";
    }
    else {
        var credentials = new Object();
        credentials.username = resetname;

        var login = new XMLHttpRequest();
        login.open("POST", "/user/login", true);
        login.setRequestHeader("Content-Type", "application/json");

        login.onload = function () {
            response = JSON.parse(login.responseText);

            if (response.message == "3") {
                document.getElementById("resetinfotext").style.display = "block";
            }
            else {
                var check = new XMLHttpRequest();
                check.open("GET", "/user/check/" + resetname, true);
                check.setRequestHeader("Content-Type", "application/json");

                check.onload = function () {
                    ueser_array_reset = JSON.parse(check.responseText);
                    changepassword();
                };
                check.send();
            }
        }
    }
}

function changepassword() {
    //should be done in php
    userid = ueser_array_reset[0].user_id;
    newps = rand(8);

    var userinfo = new Object;
    userinfo.user_password = newps;

    var update = new XMLHttpRequest();
    update.open("PUT", "/user/updatepassword/" + userid, true)
    update.setRequestHeader("Content-Type", "application/json");
    update.send(JSON.stringify(userinfo));
    document.getElementById("resetconfirmmodal").style.display = "block";
    document.getElementById("resettext").innerHTML = 'Your password has been reset to: ' + newps;
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