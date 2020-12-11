/** 
 * flags used to check if the data has been validated and data will only be processed if the validation function is run. 
 * 
 * if the function is run, it will return 1, else it will return 0  
 * where the 0s from left to right represents the following textfields
 * username,
 * name,
 * mobile number,
 * email,
 * address,
 * password,
 * confirm password 
 *  
 * */
var FunctionUsed = [0, 0, 0, 0, 0, 0, 0];

/***
 * @description The following function checks if both array are identical 
 * 
 * @param array a The first array supplied to be checked
 * @param array b The second array supplied to be checked against 
 * 
 * @return Boolean If the array matches, the function will return 1 else it will return 0 
 */

function matchesArray(a, b) {
    if (a.length != b.length) {
        return 0;
    }

    for (var i = 0; i < a.length; i++) {
        if (a[i] != b[i]) {
            return 0;
        }
    }
    return 1;
}

/***
  * @description displaying the relevant page to allow user to interact with the website efficiently
  * 
  * @param  null
  * 
  * @return null           
*/

function checkLoggedin() {
    //check if user is logged in
    if (sessionStorage.getItem("loginstatus") == "true") {
        loggedIn();
    }
    else {
        shloginbtn();
    }
}

/**
 * @description filtering user input to prevent user from entering malicious character into the email field
 *
 * @param String $field retriving the name of the field and validate it against user input
 * 
 * @return null
 */

function userInputFilters(textFieldID) {
    var text = document.getElementById(textFieldID).value;
    document.getElementById(textFieldID).value = text.replace(/([<&%>()=+""^*/;:''~`]|(phpinfo)?)/g, '');

    //will cause an error if index does not exist
    var index = 500;

    switch (textFieldID) {

        // for sign up form
        case "usernamesignupbox": index = 0; break;
        case "namesignupbox": index = 1; break;
        case "mobilenosignupbox": index = 2; break;
        case "emailsignupbox": index = 3; break;
        case "addrsignupbox": index = 4; break;
        case "tpwsignupbox": index = 5; break;
        case "pwsignupbox": index = 6; break;

        // for login and account activation login form  
        case "usernamebox": index = 0; break;
        case "passwordbox": index = 5; break;

        //for forget password form 
        case "resetPasswdEmail": index = 0; break;
    }
    FunctionUsed[index] = 1;
}

/***
  * @description ensure that users entered all the data into the fields before passing the data to PHP for processing 
  * 
  * @param  null
  * 
  * @return  null
*/

function usersignup() {
    // check if all fields are filled and confirm password matches
    var usernamesignup = document.getElementById("usernamesignupbox").value;
    var namesignup = document.getElementById("namesignupbox").value;
    var emailsignup = document.getElementById("emailsignupbox").value;
    var numbersignup = document.getElementById("mobilenosignupbox").value;
    var addresssignup = document.getElementById("addrsignupbox").value;
    var tpwsignup = document.getElementById("tpwsignupbox").value;
    var pwsignup = document.getElementById("pwsignupbox").value;

    // array used to checked against if all the validation function is run 
    var allFunctionUsed = [1, 1, 1, 1, 1, 1, 1];

    if (matchesArray(FunctionUsed, allFunctionUsed) == 1) {

        // checking if there is an input in the text field and return 1 or 0 
        // where 1 = there are missing fields 
        // and 0 = there are no missing fields 
        if (usernamesignup == "" || namesignup == "" || emailsignup == "" || numbersignup == "" || addresssignup == "" || tpwsignup == "" || pwsignup == "") {
            document.getElementById("parseflag").value = "1";
            //alert("confirm password: " + document.getElementById("parseflag").value);
        }

        else if ((usernamesignup != "" && namesignup != "" && emailsignup != "" && numbersignup != "" && addresssignup != "" && tpwsignup != "" && pwsignup != "")) {
            document.getElementById("parseflag").value = "0";
            //alert("confirm password: " + document.getElementById("parseflag").value);

        }
    }
    else {
        document.getElementById("parseflag").value = "1";
    }
}

/***
  * @description ensure that users entered all the data into the fields before passing the data to PHP for processing 
  * 
  * @param  null
  * 
  * @return null           
*/

function userLogin() {
    //alert("login");
    // check if all fields are filled and confirm password matches
    var usernamelogin = document.getElementById("usernamebox").value;
    var passwdlogin = document.getElementById("passwordbox").value;

    // array used to checked against if all the validation function is run 
    var allFunctionUsed = [1, 0, 0, 0, 0, 1, 0];

    if (matchesArray(FunctionUsed, allFunctionUsed) == 1) {

        //checking if there is an input in the text field and return 1 or 0 
        // where 1 = there are missing fields 
        // and 0 = there are no missing fields 
        if (usernamelogin == "" || passwdlogin == "") {
            document.getElementById("loginParseflag").value = "1";
            // alert("Login Flag: " + document.getElementById("loginParseflag").value);
        }

        else if ((usernamelogin != "" && passwdlogin != "")) {
            document.getElementById("loginParseflag").value = "0";
            // alert("Login Flag: " + document.getElementById("loginParseflag").value);

        }
    }
    else {
        document.getElementById("loginParseflag").value = "1";
    }
}

/***
  * @description ensure that users entered all the data into the fields before passing the data to PHP for processing 
  * 
  * @param  null
  * 
  * @return null           
*/

function passwdRecovery() {
    // check if the email field is filled 
    var resetPasswdEmail = document.getElementById("resetPasswdEmail").value;

    // array used to checked against if all the validation function is run 
    var allFunctionUsed = [0, 0, 0, 1, 0, 0, 0];

    if (matchesArray(FunctionUsed, allFunctionUsed) == 1) {

        //checking if there is an input in the text field and return 1 or 0 
        // where 1 = there are missing fields 
        // and 0 = there are no missing fields 
        if (resetPasswdEmail == "" ) {
            document.getElementById("resetParseflag").value = "1";
            // alert("Login Flag: " + document.getElementById("loginParseflag").value);
        }

        else if ((usernamelogin != "" && passwdlogin != "")) {
            document.getElementById("resetParseflag").value = "0";
            // alert("Login Flag: " + document.getElementById("loginParseflag").value);

        }
    }
    else {
        document.getElementById("resetParseflag").value = "1";
    }
}

/***
  * @description setting the relevant information to be displayed on the website
  * 
  * @param  null
  * 
  * @return null           
*/

function loggedIn() {
    //get logged in username and display in welcome text, should be done with $_session in php, remove when necessary
    if (localStorage.getItem("loginstatus") == "true" || sessionStorage.getItem("loginstatus") == "true") {
        shuserbtn();
        if (sessionStorage.getItem("user") == "null" || sessionStorage.getItem("user") == "" || sessionStorage.getItem("user") == null) {
            document.getElementById("usergreet").innerHTML = "Welcome, " + localStorage.getItem("user");
        }
        else {
            document.getElementById("usergreet").innerHTML = "Welcome, " + sessionStorage.getItem("user");
        }

    }
    else {
        shloginbtn();
    }
}


/***
  * @description remove all session set to logged out the user completely
  * 
  * @param  null
  * 
  * @return null           
*/

function logout() {
    //logout the user and remove username in storage, should be done with $_session in php, remove when necessary
    localStorage.setItem("loginstatus", false);
    localStorage.setItem("user", "");
    sessionStorage.setItem("loginstatus", false);
    sessionStorage.setItem("user", "");
}

/***
  * @description display countdown timer to user after login attempt failed
  * 
  * @param  null
  * 
  * @return null           
*/

function startCountdown(attemptsFail){
    var count = 20 * attemptsFail ;
    displayingTimer = setInterval(function(){
        if(count >= 0){
            document.getElementById("countdown").innerHTML = " <b>Error:</b> Too many failed login attempts. Please try again in "+count+" seconds.";
        }
        if (count == 0){
            window.location.href = "./home.php";
            $.ajax({
                type:'post',
                url:'./home.php',
                data:{
                    login:"login"
                },
                success:function(response){
                    window.location = "./home.php";
                }
            });
        }
        count--;
    }, 1000
    );
    
}

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
  * @description Displaying the name of the user when the user logged in and remove the login button
  * @param  null
  * @return  null           
*/

function shuserbtn() {
    var x = document.getElementById("userbtncontainer");
    if (x.style.display === "none") {
        x.style.display = "block";
        document.getElementById("loginbtncontainer").style.display = "none";
    } else {
        x.style.display = "none";
    }
}
