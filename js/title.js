/* 
Name: Michael Perron
Coding 05
Purpose: This page is to add the needed js to make page title generating
form perform correctly.
*/
"use strict";

//clear function
function clearForm() {
    $('#title').val('');
    $('#drink').val('');
    $('#pet').val('');
    $('#ficPlace').val('');
    $('#rlPlace').val('');
    $('#email').val('');
    $('#remail').val('');
    $('#re_from').val('');
    $('#msg').html('<br>'); // minor violation of concerns, but okay for now
}

function validate() {
    //empty error message
    var errorMessage = "";

    //get the strings from the text boxes and trim them
    var titleName = $('#title').val().trim();
    var drinkName = $('#drink').val().trim();
    var petName = $('#pet').val().trim();
    var ficName = $('#ficPlace').val().trim();
    var rlName = $('#rlPlace').val().trim();
    var emailName = $('#email').val().trim();
    var remailName = $('#remail').val().trim();
    
    //put the trimmed versions back into the form for good iser experience (UX)
    $('#title').val(titleName);
    $('#drink').val(drinkName);
    $('#pet').val(petName);
    $('#ficPlace').val(ficName);
    $('#rlPlace').val(rlName);
    $('#email').val(emailName);
    $('#remail').val(remailName);

    //test strings; store error messages
    if (titleName === "") {
        errorMessage += "Title cannot be empty.<br>";
    }
    if (drinkName === "") {
        errorMessage += "Favorite Drink cannot be empty.<br>";
    }
    if (petName === "") {
        errorMessage += "Pet Name name cannot be empty.<br>";
    }
    if (ficName === "") {
        errorMessage += "Fictional Place cannot be empty.<br>";
    }
    if (rlName === "") {
        errorMessage += "Real Place cannot be empty.<br>";
    }
    if (emailName === "" || !validEmail(emailName)) {
        errorMessage += "Email cannot be empty or an invalid address.<br>";
    }
    if (remailName === "") {
        errorMessage += "Email confirmation cannot be empty.<br>";
    }
    if (!(remailName == emailName)){
        errorMessage += "Email confirmation must match the above email.<br>";
    }
    if (ficName === rlName) {
        errorMessage += "The fictional place & real place cannot match.<br>";
    }
    //send the errors back or send an empty string if there is no error
    return errorMessage;
}

$(document).ready(function () {

    $("#names-clear").click(function () {
        clearForm();
    });

    $("#names-send").click(function () {
        var msg = validate();
        
        if (msg === "") {
            return true;
        } else {
            $("#msg").html(msg);
            return false;
        }
    });
});