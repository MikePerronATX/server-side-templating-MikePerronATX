/* 
Name: Michael Perron
Coding 06 - RAW JS
Purpose: This page is to add the needed js to make page title generating
form perform correctly.
*/
"use strict";

function clearForm() {
    document.getElementById("title").value = "";
    document.getElementById("drink").value = "";
    document.getElementById("pet").value = "";
    document.getElementById("ficPlace").value = "";
    document.getElementById("rlPlace").value = "";
    document.getElementById("email").value = "";
    document.getElementById("remail").value = "";
    
    document.getElementById("msg").innerHTML = "<br>";// minor violation of concerns, but okay for now
}

function sendData(){
    
    let msgArea = document.getElementById("msg");

    const XHR = new XMLHttpRequest();
    
    let formData = new FormData(document.getElementById("title-form"));
    
    XHR.addEventListener('load', function (event) {
            
        if (XHR.responseText < "30") {
            console.log(XHR.responseText);
            // clearForm();
            msgArea.innerHTML = "That’s a cute little title";
        }
        else {
            console.log(XHR.responseText);
            // clearForm();
            msgArea.innerHTML = "That’s a heck of a title";
        }
    });

    XHR.addEventListener('error', function (event) {
        if (XHR.statusText !== "OK") {
            msgArea.innerHTML = "Server Error";
        }
    });

    XHR.open('POST', 'process.php');
    XHR.send(formData);
    
    return;
}

function validate() {
    let errorMessage = "";

    let msgArea = document.getElementById("msg");

    let titleNameInput = document.getElementById("title");
    let drinkNameInput = document.getElementById("drink");
    let petNameInput = document.getElementById("pet");
    let ficNameInput = document.getElementById("ficPlace");
    let rlNameInput = document.getElementById("rlPlace");
    let emailNameInput = document.getElementById("email");
    let remailNameInput = document.getElementById("remail");

    let titleName = titleNameInput.value.trim();
    let drinkName = drinkNameInput.value.trim();
    let petName = petNameInput.value.trim();
    let ficName = ficNameInput.value.trim();
    let rlName = rlNameInput.value.trim();
    let emailName = emailNameInput.value.trim();
    let remailName = remailNameInput.value.trim();
    
    titleNameInput.value = titleName;
    drinkNameInput.value = drinkName;
    petNameInput.value = petName;
    ficNameInput.value = ficName;
    rlNameInput.value = rlName;
    emailNameInput.value = emailName;
    remailNameInput.value = remailName;

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
        console.log("calling ajax");
        sendData();
    } else {
        console.log("errors");
        msgArea.innerHTML = errorMessage;
    }
    
    return;
}

let sendBtn = document.getElementById("names-send");

sendBtn.onclick = function () {
    validate();
};

let clearBtn = document.getElementById("names-clear");

clearBtn.onclick = function () {
    clearForm();
};