 "use strict";

//Efface le textbox.
function clearbox(textbox) {
	var box = document.getElementsByName(textbox)[0];
    box.value="";
}

//Affiche la valeur value dans le textbox.
function value_survol(textbox, value) {
	var box = document.getElementsByName(textbox)[0];
	if (typeof value !== 'undefined') {
    box.value = value;
	} else {
		box.value = "";
	}
}

//Affiche un cadre jaune autour du dé lorsqu'on clique sur le dé, ou enlève le
//	cadre jaune si on reclique sur l'image.
function image_check(checkbox, image) {
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

//Affiche un cadre jaune autour du dé associé au checkbox, lorsqu'on clique sur 
//	le checkbox, ou enlève le cadre jaune si on reclique sur le checkbox.
function checkbox(checkbox, image) {
	var checkbox = document.getElementsByName(checkbox)[0];
	var image = document.getElementsByName(image)[0];
	if (checkbox.checked === false) {
		image.style.border = "";
		image.style.borderRadius= "";
	} else {
		image.style.border = "2px solid yellow";
		image.style.borderRadius= "6px";
	}
}