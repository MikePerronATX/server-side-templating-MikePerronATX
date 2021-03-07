/* 
Name: Michael Perron
Coding 05
Purpose: This page is to add the needed js to make page contact form perform correctly.
*/
"use strict";

function clearForm() {
     $('#name').val('');
     $('#subject').val('');
     $('#from').val('');
     $('#re_from').val('');
     $('#message').val('');
     $('#msg').html('<br>'); // minor violation of concerns, but okay for now
}
function validate() {
    var errorMessage = "";

    var contactName = $('#name').val().trim();
    var contactFrom = $('#from').val().trim();
    var contactRe_from = $('#re_from').val().trim();
    var contactSub = $('#subject').val().trim();
    var contactMess = $('#message').val().trim();
    
    $('#name').val(contactName);
    $('#from').val(contactFrom);
    $('#re_from').val(contactRe_from);
    $('#subject').val(contactSub);
    $('#message').val(contactMess);
    
    if (contactName === "") {
        errorMessage += "Name cannot be empty.<br>";
    }
    if (contactFrom === "" || !validEmail(contactFrom)) {
        errorMessage += "Email cannot be empty or an invalid address.<br>";
    }
    if (contactRe_from === "") {
        errorMessage += "Confirmation email cannot be empty.<br>";
    }
    if (!(contactRe_from == contactFrom)){
        errorMessage += "Email confirmation must match the above email.<br>";
    }
    if (contactSub === "") {
        errorMessage += "Subject line cannot be empty.<br>";
    }
    if (contactMess === "") {
        errorMessage += "Message cannot be empty.<br>";
    }
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
