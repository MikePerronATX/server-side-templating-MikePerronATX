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

