/* 
Name: Michael Perron
Coding 06
Purpose: This page is to add the needed js to make page title generating
form perform correctly.
*/
"use strict";

//clear function
function clearForm() {
    document.getElementById("title").value = "";
    document.getElementById("drink").value = "";
    document.getElementById("pet").value = "";
    document.getElementById("ficPlace").value = "";
    document.getElementById("rlPlace").value = "";
    document.getElementById("email").value = "";
    document.getElementById("remail").value = "";
    // document.getElementById("#re_from").value = "";
    document.getElementById("msg").innerHTML = "<br>";// minor violation of concerns, but okay for now
}

function sendData(){
    //bring the message area in to report errors or "Sent!"
    let msgArea = document.getElementById("msg");

    // creat an XMLHttpRequest object
    const XHR = new XMLHttpRequest();
    
    let formData = new FormData(document.getElementById("title-form"));

    XHR.addEventListener('load', function (event) {
        if (XHR.responseText === "okay") {
            console.log(XHR.responseText); // for debug
            // you have to clear the form here, not in the handler
            clearForm();
            msgArea.innerHTML = "Sent!";
        } else {
            msgArea.innerHTML = "Processing Error";
        }
    });

    XHR.addEventListener('error', function (event) {
        if (XHR.statusText !== "OK") {
            msgArea.innerHTML = "Server Error";
        }
    });

    // this opens the connection and sends the form
    XHR.open('POST', 'process.php');
    XHR.send(formData);
    
    return;
}

function validate() {
    // start with an empty error message
    let errorMessage = "";

    //bring the message area in to report errors
    let msgArea = document.getElementById("msg");

    //get all the elements into the function
    let titleNameInput = document.getElementById("title");
    let drinkNameInput = document.getElementById("drink");
    let petNameInput = document.getElementById("pet");
    let ficNameInput = document.getElementById("ficPlace");
    let rlNameInput = document.getElementById("rlPlace");
    let emailNameInput = document.getElementById("email");
    let remailNameInput = document.getElementById("remail");

    //get all the strings in the elements and trim them
    let titleName = titleNameInput.value.trim();
    let drinkName = drinkNameInput.value.trim();
    let petName = petNameInput.value.trim();
    let ficName = ficNameInput.value.trim();
    let rlName = rlNameInput.value.trim();
    let emailName = emailNameInput.value.trim();
    let remailName = remailNameInput.value.trim();
    

    //put the trimmed versions back into the form for good user experience (UX)
    titleNameInput.value = titleName;
    drinkNameInput.value = drinkName;
    petNameInput.value = petName;
    ficNameInput.value = ficName;
    rlNameInput.value = rlName;
    emailNameInput.value = emailName;
    remailNameInput.value = remailName;

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
    if(errorMessage === ""){
        // no errors, so send the data to the server
        console.log("calling ajax");
        sendData();
    } else {
        // report errors if there are any
        console.log("errors");
        msgArea.innerHTML = errorMessage;
    }
    
    return;
}

//get the button into a JS object
let sendBtn = document.getElementById("names-send");

//create an event listener and handler for the send button
sendBtn.onclick = function () {
    // only need to call validate. validate will call sendData
    validate();
};

//get the button into a JS object
let clearBtn = document.getElementById("names-clear");

//create an event listener and handler for the clear button
clearBtn.onclick = function () {
    //call clear if the button is pressed
    clearForm();
};