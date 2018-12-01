 "use strict";
function count_occurences(dice_tab){
	var result_tab = {};
	dice_tab.forEach(function(elt){
		if(elt in result_tab){
			result_tab[elt] = result_tab[elt] + 1;
		}
		else{
			result_tab[elt] = 1;
		}
	});
	return result_tab;
}

function is_n_identical_dice(n, dice_tab_occ) {
	if (n > 2) {
		for (var k in dice_tab_occ) {
			if(dice_tab_occ[k] >= n) {
				return true;
			}
		}
	} else {
		for (var i in dice_tab_occ) {
			if(dice_tab_occ[i] === n) {
				return true;
			}
		}
	}
	return false;
}

function delete_multi_value(dice_tab) {
  var tab2 = [];
  var k1 = 0;
  for (var k = 0; k < dice_tab.length; ++k) {
		if (dice_tab[k] !== dice_tab[k+1]) {
		  tab2[k1] = dice_tab[k];
		  ++k1;
		}
  }
  return tab2;
}

function is_n_suite(n, dice_tab) {
  var tot = false;
  var n1 = 1;
  var tab1 = dice_tab.sort();
  var tab2 = delete_multi_value(tab1);
  var i = 0;
  while(i < tab2.length - 1 && n1 < n) {
    if (tab2[i] === tab2[i+1]-1) {
      tot = true;
      ++n1;
    } else {
      n1 = 1;
      tot = false;
    }
    ++i;
  }
  return tot&&(n1 == n);
}

function clearbox(textbox) {
	var box = document.getElementsByName(textbox)[0];
    box.value="";
}

function value_survol(button, textbox, de1, de2, de3, de4, de5) {
	var dice_tab = [de1, de2, de3, de4, de5];
	console.log(dice_tab);
	var box = document.getElementsByName(textbox)[0];
    box.value = calcul(button, dice_tab);
}

function calcul(button, dice_tab) {
	var dice_tab_occ = count_occurences(dice_tab);
	const add = (acc, currentvalue) => acc + currentvalue;
	switch(button) {
		case 'bouton1':
			if (dice_tab_occ[1] !== undefined) {
				return dice_tab_occ[1];
			} else {
				return "";
			}
			break;
		case 'bouton2':
			if (dice_tab_occ[2] !== undefined) {
				return dice_tab_occ[2]*2;
			} else {
				return "";
			}
			break;
		case 'bouton3':
			if (dice_tab_occ[3] !== undefined) {
				return dice_tab_occ[3]*3;
			} else {
				return "";
			}
			break;
		case 'bouton4':
			if (dice_tab_occ[4] !== undefined) {
				return dice_tab_occ[4]*4;
			} else {
				return "";
			}
			break;
		case 'bouton5':
			if (dice_tab_occ[5] !== undefined) {
				return dice_tab_occ[5]*5;
			} else {
				return "";
			}
			break;
		case 'bouton6':
			if (dice_tab_occ[6] !== undefined) {
				return dice_tab_occ[6]*6;
			} else {
				return "";
			}
			break;
		case 'boutonbrelan':
			if (is_n_identical_dice(3, dice_tab_occ) === true) {
				return dice_tab.reduce(add);
			} else {
				return "";
			}
			break;
		case 'boutoncarre':
			if (is_n_identical_dice(4, dice_tab_occ) === true) {
				return dice_tab.reduce(add);
			} else {
				return "";
			}
			break;
		case 'boutonfull':
			if (is_n_identical_dice(3, dice_tab_occ) === true && is_n_identical_dice(2, dice_tab_occ) === true) {
				return 25;
			} else {
				return "";
			}
			break;
		case 'boutonpsuite':
			if (is_n_suite(4, dice_tab) === true) {
				return 30;
			} 
		case 'boutongsuite':
			if (is_n_suite(5, dice_tab) === true) {
				return 40;
			} else {
				return "";
			}
			break;
		case 'boutonyahtzee':
			if (delete_multi_value(dice_tab).length === 1) {
				return 50;
			} else {
				return "";
			}
			break;
		case 'boutonchance':
			return dice_tab.reduce(add);
			break;
	}
}