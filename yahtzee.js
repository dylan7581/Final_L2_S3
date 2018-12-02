 "use strict";

function clearbox(textbox) {
	var box = document.getElementsByName(textbox)[0];
    box.value="";
}

function value_survol(textbox, value) {
	var box = document.getElementsByName(textbox)[0];
	if (typeof value !== 'undefined') {
    box.value = value;
	} else {
		box.value = "";
	}
}