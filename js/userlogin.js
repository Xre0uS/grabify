/***
 * @description The following function allows the code to locate the index and replace the string 
 * @param Int index The location to locate the characters to be replaced to
 * @param vars replacement The characters to be replaced to 
 * @return the characters that is being replaced 
 */

String.prototype.replaceAt = function (index, replacement) {
    return this.substr(0, index) + replacement + this.substr(index + replacement.length);
}

function checkLoggedin() {
    //check if user is logged in
    if (sessionStorage.getItem("loginstatus") == "true") {
        userLogin();
    }
    else {
        shloginbtn();
    }
}

/***
  * @description filtering user input to prevent user from entering malicious character into the username field
  * @param  null
  * @return  remove malicious character upon user input           
*/

function usernameFilter() {
    var username = document.getElementById("usernamesignupbox").value;

    document.getElementById("usernamesignupbox").value = username.replace(/([<&%>().=+""?!$@#^*-/_;:'']|(phpinfo)?)/g, '');

}

/***
  * @description filtering user input to prevent user from entering malicious character into the name field
  * @param  null
  * @return  remove malicious character upon user input           
*/

function nameFilter() {
    var name = document.getElementById("namesignupbox").value;

    document.getElementById("namesignupbox").value = name.replace(/([<&%>().=+""?!$@#^*-/_;:'']|(phpinfo)?)/g, '');
}

function nameFilter() {
    var name = document.getElementById("namesignupbox").value;
    document.getElementById("namesignupbox").value = name.replace(/([<&%>().=+""?!$@#^*-/_;:'']|(phpinfo)?)/g, '');
}

/***
  * @description filtering user input to prevent user from entering malicious character into the mobile number field
  * @param  null
  * @return  remove malicious character upon user input           
*/

function mobilenoFilter() {
    var mobileno = document.getElementById("mobilenosignupbox").value;

    document.getElementById("mobilenosignupbox").value = mobileno.replace(/([A-Za-z<&%>().=+""?!$@#^*-/_;:'']|(phpinfo)?)/g, '');
}

function mobilenoFilter() {
    var mobileno = document.getElementById("mobilenosignupbox").value;
    document.getElementById("mobilenosignupbox").value = mobileno.replace(/([A-Za-z<&%>().=+""?!$@#^*-/_;:'']|(phpinfo)?)/g, '');
}

/***
  * @description filtering user input to prevent user from entering malicious character into the email field
  * @param  null
  * @return  remove malicious character upon user input           
*/

function emailFilter() {
    var email = document.getElementById("emailsignupbox").value;

    document.getElementById("emailsignupbox").value = email.replace(/([<&%>()=+""?!$#^*/;:'']|(phpinfo)?)/g, '');

}

/***
  * @description filtering user input to prevent user from entering malicious character into the address field
  * @param  null
  * @return  remove malicious character upon user input           
*/

function addrFilter() {
    var addr = document.getElementById("addrsignupbox").value;

    document.getElementById("addrsignupbox").value = addr.replace(/([<&%>().=+""?!$@#^*-/_;:'']|(phpinfo)?)/g, '');
}

/***
  * @description filtering user input to prevent user from entering malicious character into the password field
  * @param  null
  * @return  remove malicious character upon user input           
*/

function tpwFilter() {
    var tpw = document.getElementById("tpwsignupbox").value;

    document.getElementById("tpwsignupbox").value = tpw.replace(/([<>().=+""&%^*-/_;:'']|(phpinfo)?)/g, '');

}

/***
  * @description filtering user input to prevent user from entering malicious character into the confirm password field
  * @param  null
  * @return  remove malicious character upon user input           
*/

function pwFilter() {
    var pw = document.getElementById("pwsignupbox").value;

    document.getElementById("pwsignupbox").value = pw.replace(/([<>().=+""&%^*-/_;:'']|(phpinfo)?)/g, '');


}

/***
 * @description The following function validates the user input and returns error messages 
 * @param String passwd The password entered by the user is supplied 
 * @return 1 is return if the value does not contain the password criteria specified 
 */

function validatePasswd(passwd) {
    if (!passwd.match(/[!@#$@?0-9A-Za-z]{8,}/g)) {
        return (document.getElementById("parseflag").value = "<<lessthan8chara>>");
    }

    if ((passwd.match(/[!@#$@?0-9A-Za-z]+/g)) && (!passwd.match(/.*[!@#$@?].*/g))) {
        return (document.getElementById("parseflag").value = "<<noSpcialCharacters>>");
    }

    if ((passwd.match(/[!@#$@?0-9A-Za-z]+/g)) && (!passwd.match(/.*[0-9]./g))) {
        return (document.getElementById("parseflag").value = "<<noNumber>>");
    }

    if ((passwd.match(/[!@#$@?0-9A-Za-z]+/g)) && (!passwd.match(/.*[A-Z]./g))) {
        return (document.getElementById("parseflag").value = "<<noCaps>>");
    }

    if ((passwd.match(/[!@#$@?0-9A-Za-z]+/g)) && (!passwd.match(/.*[a-z]./g))) {
        return (document.getElementById("parseflag").value = "<<noNonCaps>>");
    }
}

/***
  * @description ensure that users entered all the data into the fields before passing the data to PHP for processing 
  * @param  null
  * @return  change the html style to display error messages if fields are left empty or if the passwords do no match 
  * @return  error messages will also be displayed if it does not match the appropriate validation 
  * @return  if the data matches all the validation, it will be parse to PHP for processing            
*/

function usersignup() {
    alert("hi");
    //handles signup functions, check if all fields are filled and confirm password matches
    var usernamesignup = document.getElementById("usernamesignupbox").value;
    var namesignup = document.getElementById("namesignupbox").value;
    var emailsignup = document.getElementById("emailsignupbox").value;
    var numbersignup = document.getElementById("mobilenosignupbox").value;
    var addresssignup = document.getElementById("addrsignupbox").value;
    var tpwsignup = document.getElementById("tpwsignupbox").value;
    var pwsignup = document.getElementById("pwsignupbox").value;

    //checking if there is an input in the text field and return 1 or 0 
    // where 1 = there are missing fields 
    // and 0 = there are no missing fields 
    if (usernamesignup == "" || namesignup == "" || emailsignup == "" || numbersignup == "" || addresssignup == "" || tpwsignup == "" || pwsignup == "") {
        document.getElementById("parseflag").value = "1";
        alert("confirm password: " + document.getElementById("parseflag").value);
    }
    var checkEmail = emailsignup.search("@");
    validatePasswd(tpwsignup);

    //Testing using a function called replacedAt to replace the characters in the string 

    /** 
     * flags used to validate the data entered by user input and display error message when the value is 1, else it will return 0 
     * where the zero starting from left to right represents 
     * checking if the is any data in the textfield,
     * check if the username has been taken,
     * check the format of the email address,
     * check the format of address entered,
     * the length of the password,
     * if there is any speical characters in the password,
     * if there is a number in the password,
     * if there is one upper and lowercase alphabet in the password field, 
     * if the password field and the confirm password field matches. 
     * 
     * */
    var displayErrorMessage = "0, 0, 0, 0, 0, 0, 0, 0, 0";

    if (usernamesignup == "" || namesignup == "" || emailsignup == "" || numbersignup == "" || addresssignup == "" || tpwsignup == "" || pwsignup == "") {
        displayErrorMessage.replaceAt(0, "1");
        alert(displayErrorMessage);
    }

    else if ((usernamesignup != "" && namesignup != "" && emailsignup != "" && numbersignup != "" && addresssignup != "" && tpwsignup != "" && pwsignup != "")) {
        alert(displayErrorMessage);
        break;
    }
    else if ((usernamesignup != "" && namesignup != "" && emailsignup != "" && numbersignup != "" && addresssignup != "" && tpwsignup != "" && pwsignup != "")) {
        document.getElementById("parseflag").value = "0";
        alert("confirm password: " + document.getElementById("parseflag").value);

    }

    if (tpwsignup !== pwsignup) {
        alert("in elif");
        document.getElementById("parseflag").value = "<<passwordnotmatch>>";
        alert("confirm password: " + document.getElementById("parseflag").value);
    }


    if (checkEmail == 0 || checkEmail <= -1) {
        document.getElementById("parseflag").value = "<<invalid email>>";
        alert("confirm password: " + document.getElementById("parseflag").value);

    }
}
/* else {
    sessionStorage.setItem("loginstatus", true);
    sessionStorage.setItem("loggedinid", "1");
    sessionStorage.setItem("loggedusername", "User");
    location.reload();
     var usernameinput = document.getElementById("usernamesignupbox").value;
 
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
    login.send(JSON.stringify(credentials)); 
}
}
/*
 
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
location.reload(); 
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
*/

/* show and hide models */
var modal = document.getElementById('loginModalContainer');
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/***
  * @description Displaying the model to allow user to login
  * @param  null
  * @return  null           
*/

function shloginmodel() {
    var x = document.getElementById("loginModalContainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

/***
  * @description Displaying the model to allow user to reset their password 
  * @param  null
  * @return  null           
*/

function shloginbtn() {
    var x = document.getElementById("loginbtncontainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

/***
  * @description Displaying the model to allow user to reset their password 
  * @param  null
  * @return  null           
*/

function passwdResetModal() {
    var x = document.getElementById("passwdResetModel");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

/***
  * @description Displaying the signup model when the user clicked on the signup button  
  * @param  null
  * @return  null           
*/

function shsignupmodal() {
    var x = document.getElementById("userSignupContainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

/***
  * @description Displaying the name of the user when the user logged in 
  * @param  null
  * @return  null           
*/

function shuserbtn() {
    var x = document.getElementById("userbtncontainer");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
