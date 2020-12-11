/** 
 * flags used to check if the data has been validated and data will only be processed if the validation function is run. 
 * 
 * if the function is run, it will return 1, else it will return 0  
 * where the 0s from left to right represents the following textfields
 * email
 * mobile number,
 * address,
 * old password,
 * new password,
 * confirm password 
 *  
 * */
var FunctionUsed = [0, 0, 0, 0, 0, 0];

var user_array = [];
var userid = "";
var username;
var user_img_g = "";


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

        // for updating user info
        case "emailbox": index = 0; break;
        case "numbox": index = 1; break;
        case "addbox": index = 2; break;

        // for update password   
        case "oldpwbox": index = 3; break;
        case "newpwbox": index = 4; break;
        case "cnewpwbox": index = 5; break;

    }
    FunctionUsed[index] = 1;
}

/***
  * @description ensure that users entered all the data into the fields before passing the data to PHP for processing 
  * 
  * @param  null
  * 
  * @return null           
*/

function updateinfo() {
    var email = document.getElementById("emailbox").value;
    var number = document.getElementById("numbox").value;
    var address = document.getElementById("addbox").value;

        // array used to checked against if all the validation function is run 
        var allFunctionUsed = [1, 1, 1, 0, 0, 0];

        if (matchesArray(FunctionUsed, allFunctionUsed) == 1) {
    
            //checking if there is an input in the text field and return 1 or 0 
            // where 1 = there are missing fields 
            // and 0 = there are no missing fields 
            if (email == "" || number == "" || address == "" ) {
                document.getElementById("updateParseflag").value = "1";
            }
    
            else if ((usernamelogin != "" && passwdlogin != "")) {
                document.getElementById("updateParseflag").value = "0";
                // alert("Login Flag: " + document.getElementById("loginParseflag").value);
    
            }
        }
        else {
            document.getElementById("updateParseflag").value = "1";
        }
}

/***
  * @description ensure that users entered all the data into the fields before passing the data to PHP for processing 
  * 
  * @param  null
  * 
  * @return null           
*/

function updatepasswd() {
    var oldpass = document.getElementById("oldpwbox").value;
    var newpass = document.getElementById("newpwbox").value;
    var cfmpass = document.getElementById("cnewpwbox").value;

        // array used to checked against if all the validation function is run 
        var allFunctionUsed = [0, 0, 0, 1, 1, 1];

        if (matchesArray(FunctionUsed, allFunctionUsed) == 1) {

            //checking if there is an input in the text field and return 1 or 0 
            // where 1 = there are missing fields 
            // and 0 = there are no missing fields 
            if (oldpass == "" || newpass == "" || cfmpass == "" ) {
                document.getElementById("pUpdateParseflag").value = "0";
            }
    
            else if (oldpass != "" && newpass != "" && cfmpass != "") {
                document.getElementById("pUpdateParseflag").value = "0";
    
            }
        }
        else {
            document.getElementById("pUpdateParseflag").value = "1";
        }
}

/***
  * @description displaying the model to tell user that their profile has been changed successfully
  * 
  * @param  null
  * 
  * @return null           
*/

function updateinfomodel() {
    document.getElementById("updateinfomodal").style.display = "block"
}

/***
  * @description displaying the model to tell user that their password has been changed successfully
  * 
  * @param  null
  * 
  * @return null           
*/

function updatepasswordmodel() {
    document.getElementById("updatepasswordmodal").style.display = "block"
}

/***
  * @description displaying the model to tell user that their account has been deleted successfully
  * 
  * @param  null
  * 
  * @return null           
*/

function delusermodel() {
    document.getElementById("delmodal").style.display = "block"
}

/***
  * @description remove all session set and redirect the user to home page 
  * @param  null
  * 
  * @return null           
*/

function gohome() {
    localStorage.setItem("loginstatus", false);
    localStorage.setItem("loggedinid", "");
    localStorage.setItem("loggedusername", "");
    sessionStorage.setItem("loginstatus", false);
    sessionStorage.setItem("loggedinid", "");
    sessionStorage.setItem("loggedusername", "");
    window.location.href = "home.php"
}

function rand(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}