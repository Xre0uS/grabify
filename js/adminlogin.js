function checkLoggedin() {
    var data = { function: "checkLoggedIn" };
    $.ajax({
        type: 'POST',
        url: "php/adminloginfn.php",
        data: data,

        success: function (response) {
            var response = JSON.parse(response);
            if (response.status == 0) {
                shloginbtn();
            }
            else if (response.status == 1) {
                shuserbtn();
                document.getElementById("usergreet").innerHTML = "Welcome, " + response.username;
            } else if (response.status == 2) {
                alert(response.err);
                window.location.href = response.redirect;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
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
        var data = { function: "authenticate", username, password};
        $.ajax({
            type: 'POST',
            url: "php/adminloginfn.php",
            data: data,

            success: function (response) {
                var response = JSON.parse(response);
                if (response.status == 0) {
                    document.getElementById("loginWarn").innerText = "Incorrect username or password";
                }
                else if (response.status == 1) {
                    window.location.href = response.redirect;
                }
                else if (response.status = 3) {
                    alert(response.err);
                    window.location.href = response.redirect; 
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
}

function logout() {
    var data = { function: "logout" };
    $.ajax({
        type: 'POST',
        url: "php/adminloginfn.php",
        data: data,

        success: function (response) {
            var response = JSON.parse(response);
            window.location.href = response.redirect;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

//functions to show/hide modals
$(document).mouseup(function(e){
    var container = $("#loginModalContainer");
    if(!container.is(e.target) && container.has(e.target).length === 0){
        container.hide();
    }
  });

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
