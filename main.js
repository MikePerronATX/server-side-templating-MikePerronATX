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
    //Division of Concerns violation
    document.getElementById("msg").innerHTML = "<br>";
}

function validate() {
    //empty error message
    var errorMessage = "";
	
    //bring elements to function
    var titleInput = document.getElementById("title");
    var drinkInput = document.getElementById("drink");
    var petInput = document.getElementById("pet");
    var ficInput = document.getElementById("ficPlace");
    var rlInput = document.getElementById("rlPlace");
    var emailInput = document.getElementById("email");
    var remailInput = document.getElementById("remail");

    //trim elements
    var titleName = titleInput.value.trim();
    var drinkName = drinkInput.value.trim();
    var petName = petInput.value.trim();
    var ficName = ficInput.value.trim();
    var rlName = rlInput.value.trim();
    var emailName = emailInput.value.trim();
    var remailName = remailInput.value.trim();

    //trimmed versions goes back to the form for user.
    titleInput.value = titleName;
    drinkInput.value = drinkName;
    petInput.value = petName;
    ficInput.value = ficName;
    rlInput.value = rlName;
    emailInput.value = emailName;
    remailInput.value = remailName;

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
    if (emailName === "") {
        errorMessage += "Email cannot be empty.<br>";
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

//JS objects to variable
var sendBtn = document.getElementById("names-send");
var clearBtn = document.getElementById("names-clear");