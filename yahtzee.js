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

function checkbox(checkbox, image) {
	var checkbox = document.getElementsByName(checkbox)[0];
	var image = document.getElementsByName(image)[0];
	if (checkbox.checked === true) {
		checkbox.checked = false;
		image.style.border = "";
		image.style.borderRadius= "";
	} else {
		checkbox.checked = true;
		image.style.border = "2px solid yellow";
		image.style.borderRadius= "6px";
	}
}