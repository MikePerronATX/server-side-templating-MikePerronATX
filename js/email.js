/* 
Name: Michael Perron
Coding 06 - JQUERY
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

function sendData(contactName, contactFrom, contactRe_from, 
                                contactSub, contactMess ) {

    let msgArea = document.getElementById("msg");

    $.ajax({
        url: 'email.php',
        type: 'POST',
        data: {contactName: contactName,
                contactFrom: contactFrom,
                contactRe_from: contactRe_from,
                contactSub: contactSub,
                contactMess: contactMess},
        success: function (val) {
            console.log(val);
            if (val === 'okay') {
                clearForm();
                msgArea.innerHTML = "Your message was sent";
            } else {
                msgArea.innerHTML = "Sorry, your email was not sent";
            }
        },
        error: function () {
            msgArea.innerHTML = "Server Error1";
        }
    });

    return;
}

function validate() {
    var errorMessage = "";
   
    let msgArea = document.getElementById("msg");

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
    
    if (errorMessage === "") {
        console.log("calling ajax");
        sendData(contactName,
                    contactFrom,
                    contactRe_from,
                    contactSub,
                    contactMess);
    } else {
        console.log("errors");
        msgArea.innerHTML = errorMessage;
    }

    return;
}
$(document).ready(function () {

    $("#names-clear").click(function () {
        clearForm();
    });

    $("#names-send").click(function () {
        validate();
    });
});