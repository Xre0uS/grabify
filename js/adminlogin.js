function checkLoggedin() {
    //check if bis is logged in
    if (sessionStorage.getItem("loginstatus") == "true") {
        adminLogin();
    }
    else {
        shloginbtn();
    }
}

function adminLogin() {
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

function loginRequest() {
    var username = document.getElementById("unameField").value;
    var password = document.getElementById("pwField").value;


    if (username == "" || password == "") {
        document.getElementById("loginWarn").innerText = "Please enter all the credentials.";
    }
    else if (/^[A-Za-z0-9]+$/.test(username) == false) {
        document.getElementById("loginWarn").innerText = "Only numbers and letters are allowed in username.";
    }
    else {
        document.body.style.cursor='wait';
        var creds = { function: "auth", username, password };
        $.ajax({
            type: 'POST',
            url: "php/adminloginfn.php",
            data: creds,

            success: function (response) {
                if (/respond0/.test(response)) {
                    document.getElementById("loginWarn").innerText = "Incorrect username or password";
                }
                else if (/respond1/.test(response)) {

                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}

function logout() {
    //logout the user and remove username in storage, should be done with $_session in php, remove when necessary
    localStorage.setItem("loginstatus", false);
    localStorage.setItem("loggedinid", "");
    localStorage.setItem("loggedusername", "");
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

function shuserbtn() {
    var x = document.getElementById("userbtncontainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}