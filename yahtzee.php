<?php
  session_start();
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Yahtzee</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="yahtzee.css"/>
	</head>
	<body>
		<h1>Yahtzee</h1>
  </body>
</html>
<?php
  if(isset($_POST['lancer']) === false
		&&isset($_POST['bouton1']) === false
    &&isset($_POST['bouton2']) === false
    &&isset($_POST['bouton3']) === false
    &&isset($_POST['bouton4']) === false
    &&isset($_POST['bouton5']) === false
    &&isset($_POST['bouton6']) === false
    &&isset($_POST['boutonbrelan']) === false
    &&isset($_POST['boutoncarre']) === false
    &&isset($_POST['boutonfull']) === false
    &&isset($_POST['boutonpsuite']) === false
    &&isset($_POST['boutongsuite']) === false
    &&isset($_POST['boutonyahtzee']) === false
    &&isset($_POST['boutonchance']) === false) {
    include("init.php");
  }
  if(isset($_POST['lancer']) === true
    ||isset($_POST['bouton1']) === true
    ||isset($_POST['bouton2']) === true
    ||isset($_POST['bouton3']) === true
    ||isset($_POST['bouton4']) === true
    ||isset($_POST['bouton5']) === true
    ||isset($_POST['bouton6']) === true
    ||isset($_POST['boutonbrelan']) === true
    ||isset($_POST['boutoncarre']) === true
    ||isset($_POST['boutonfull']) === true
    ||isset($_POST['boutonpsuite']) === true
    ||isset($_POST['boutongsuite']) === true
    ||isset($_POST['boutonyahtzee']) === true
    ||isset($_POST['boutonchance']) === true) {
    //  print_dice : Affiche le dé correspondant à la valeur de la variable
    //    $_SESSION['de[n]'] où [n] est le chiffre correspondant au dé à afficher.
    //    Affiche "Erreur d'affichage" et met fin à la session en cas d'erreur.
    function print_dice($n, $c) {
      if ($n >= 1 && $n <= 6) {
        echo "<div>";
        echo "<img src='des/De$n.png' alt='Dé $n' name='img_de$c' onclick=\"checkbox('d$c', 'img_de$c')\">";
        echo "<br/>";
        echo "<input type='checkbox' name='d$c'><label>Garder</label>";
        echo "</div>";
      } else {
        echo "<p>Erreur d'affichage</p>";
        session_destroy();
      }
    }

    //  print_all_dice : Affiche tous les dés initialisés. Affiche un message d'erreur
    //    et met fin à la session en cas d'erreur sur un des dés.
    function print_all_dice(){
      print_dice($_SESSION['de1'], 1);
      print_dice($_SESSION['de2'], 2);
      print_dice($_SESSION['de3'], 3);
      print_dice($_SESSION['de4'], 4);
      print_dice($_SESSION['de5'], 5);
    }

    //  print_throw_button : Affiche le bouton "Lancer!" suivi de nombre de coups
    //    '$n' qu'il reste à l'utilisateur pour ce tour. Affiche un message d'erreur
    //    et met fin à la session si $n < 0 ou $n > 3
    function print_throw_button($n) {
      if (($n > 0)&&($n <= 3)) {
        echo "<input type='submit' name='lancer' value='Lancer! ($n)' class='button1'>";
      } else if($n == 0){
        echo "<input type='submit' name='lancer' value='Lancer! ($n)' disabled='true' class='button1'>";
      } else {
        echo "<p>Erreur: Nombre d'essais invalide.</p>";
        session_destroy();
      }
    }

    //  next_turn : Attribue aléatoirement une valeur entre 1 et 6 à chaque dé
    //    que l'utilisateur a choisi de ne pas garder puis réduit le nombre de
    //    coups qu'il/elle peut jouer.
    function next_turn() {
      if ($_POST['d1'] !== on){
        $_SESSION['de1'] = rand(1, 6);
      }
      if ($_POST['d2'] !== on){
        $_SESSION['de2'] = rand(1, 6);
      }
      if ($_POST['d3'] !== on){
        $_SESSION['de3'] = rand(1, 6);
      }
      if ($_POST['d4'] !== on){
        $_SESSION['de4'] = rand(1, 6);
      }
      if ($_POST['d5'] !== on){
        $_SESSION['de5'] = rand(1, 6);
      }
    }

    //  is_n_identical_dice : fonction qui renvoie true si il y a $n dés identique,
    //    sinon renvoie false.
    function is_n_identical_dice($n, $dice_tab_occ) {
      if ($n > 2) {
        foreach ($dice_tab_occ as $cle => $value) {
          if($value >= $n) {
            return true;
          }
        }
      } else {
        foreach ($dice_tab_occ as $cle1 => $value1) {
          if($value1 === $n) {
            return true;
          }
        }
      }
      return false;
    }

    //  is_n_suite : renvoie true si le tableau associé à $dice_tab est une suite
    //    de $n elements, renvoie false sinon.
    function is_n_suite($n, $dice_tab) {
      $tot = false;
      $n1 = 1;
      $tab1 = $dice_tab;
      sort($tab1);
      $tab2 = array_unique($tab1);
      $i = 0;
      while($i < count($tab2) - 1 && $n1 < $n) {
        if ($tab2[$i] === $tab2[$i+1]-1) {
          $tot = true;
          ++$n1;
        } else {
          $n1 = 1;
          $tot = false;
        }
        ++$i;
      }
      return $tot&&($n1 == $n);
    }

    //  calcul : fonction qui calcul, pour un bouton donné et un tableau représentant
    //    les valeurs des dés, la valeur associée.
    function calcul($button, $dice_tab) {
      $dice_tab_occ = array_count_values($dice_tab);
      switch($button) {
        case 'bouton1':
          if (array_key_exists(1, $dice_tab_occ) === true) {
            return $dice_tab_occ[1];
          } else {
            return "";
          }
          break;
        case 'bouton2':
          if (array_key_exists(2, $dice_tab_occ) === true) {
            return $dice_tab_occ[2]*2;
          } else {
            return "";
          }
          break;
        case 'bouton3':
          if (array_key_exists(3, $dice_tab_occ) === true) {
            return $dice_tab_occ[3]*3;
          } else {
            return "";
          }
          break;
        case 'bouton4':
          if (array_key_exists(4, $dice_tab_occ) === true) {
            return $dice_tab_occ[4]*4;
          } else {
            return "";
          }
          break;
        case 'bouton5':
          if (array_key_exists(5, $dice_tab_occ) === true) {
            return $dice_tab_occ[5]*5;
          } else {
            return "";
          }
          break;
        case 'bouton6':
          if (array_key_exists(6, $dice_tab_occ) === true) {
            return $dice_tab_occ[6]*6;
          } else {
            return "";
          }
          break;
        case 'boutonbrelan':
          if (is_n_identical_dice(3, $dice_tab_occ) === true) {
            return array_sum($dice_tab);
          } else {
            return "";
          }
          break;
        case 'boutoncarre':
          if (is_n_identical_dice(4, $dice_tab_occ) === true) {
            return array_sum($dice_tab);
          } else {
            return "";
          }
          break;
        case 'boutonfull':
          if (is_n_identical_dice(3, $dice_tab_occ) === true && is_n_identical_dice(2, $dice_tab_occ) === true) {
            return 25;
          } else {
            return "";
          }
          break;
        case 'boutonpsuite':
          if (is_n_suite(4, $dice_tab) === true) {
            return 30;
          } 
        case 'boutongsuite':
          if (is_n_suite(5, $dice_tab) === true) {
            return 40;
          } else {
            return "";
          }
          break;
        case 'boutonyahtzee':
          if (count(array_unique($dice_tab)) === 1) {
            return 50;
          } else {
            return "";
          }
          break;
        case 'boutonchance':
          return array_sum($dice_tab);
          break;
			}
    }

	//	update_button : Met à jour la valeur du bouton de nom $button si ce-dernier n'as pas encore été utilisé
  function update_button($button, $updateVal) {
      switch($button) {
        case 'bouton1':
          if (isset($_POST['bouton1']) === true && $_SESSION['results'][0] === -1) {
            $_SESSION['results'][0] = $updateVal;
          }
          break;
        case 'bouton2':
          if (isset($_POST['bouton2']) === true && $_SESSION['results'][1] === -1) {
            $_SESSION['results'][1] = $updateVal;
          }
          break;
        case 'bouton3':
          if (isset($_POST['bouton3']) === true && $_SESSION['results'][2] === -1) {
            $_SESSION['results'][2] = $updateVal;
          }
          break;
        case 'bouton4':
          if (isset($_POST['bouton4']) === true && $_SESSION['results'][3] === -1) {
            $_SESSION['results'][3] = $updateVal;
          }
          break;
        case 'bouton5':
          if (isset($_POST['bouton5']) === true && $_SESSION['results'][4] === -1) {
            $_SESSION['results'][4] = $updateVal;
          }
          break;
        case 'bouton6':
          if (isset($_POST['bouton6']) === true && $_SESSION['results'][5] === -1) {
            $_SESSION['results'][5] = $updateVal;
          }
          break;
        case 'boutonbrelan':
          if (isset($_POST['boutonbrelan']) === true && $_SESSION['results'][6] === -1) {
            $_SESSION['results'][6] = $updateVal;
          }
          break;
        case 'boutoncarre':
          if (isset($_POST['boutoncarre']) === true && $_SESSION['results'][7] === -1) {
            $_SESSION['results'][7] = $updateVal;
          }
          break;
        case 'boutonfull':
          if (isset($_POST['boutonfull']) === true && $_SESSION['results'][8] === -1) {
            $_SESSION['results'][8] = $updateVal;
          }
          break;
        case 'boutonpsuite':
          if (isset($_POST['boutonpsuite']) === true && $_SESSION['results'][9] === -1) {
            $_SESSION['results'][9] = $updateVal;
					}
					break;
        case 'boutongsuite':
          if (isset($_POST['boutongsuite']) === true && $_SESSION['results'][10] === -1) {
            $_SESSION['results'][10] = $updateVal;
          }
          break;
        case 'boutonyahtzee':
          if (isset($_POST['boutonyahtzee']) === true && $_SESSION['results'][11] === -1) {
            $_SESSION['results'][11] = $updateVal;
          }
          break;
        case 'boutonchance':
          if (isset($_POST['boutonchance']) === true && $_SESSION['results'][12] === -1) {
            $_SESSION['results'][12] = $updateVal;
					}
          break;
			}
    }
		
		//	update_all : Met à jour tous les boutons non initialisés au cas où l'utilisateur appuye sur eux.
		function update_all_dice($dTab) {
			update_button('bouton1', calcul('bouton1', $dTab));
			update_button('bouton2', calcul('bouton2', $dTab));
			update_button('bouton3', calcul('bouton3', $dTab));
			update_button('bouton4', calcul('bouton4', $dTab));
			update_button('bouton5', calcul('bouton5', $dTab));
			update_button('bouton6', calcul('bouton6', $dTab));
			update_button('boutonbrelan', calcul('boutonbrelan', $dTab));
			update_button('boutoncarre', calcul('boutoncarre', $dTab));
			update_button('boutonfull', calcul('boutonfull', $dTab));
			update_button('boutonpsuite', calcul('boutonpsuite', $dTab));
			update_button('boutongsuite', calcul('boutongsuite', $dTab));
			update_button('boutonyahtzee', calcul('boutonyahtzee', $dTab));
			update_button('boutonchance', calcul('boutonchance', $dTab));
		}
		
		//	update_results : Met à jour le total de la partie haute, de la partie basse, et général respectivement
		//		contenus dans $_SESSION['results'][13], $_SESSION['results'][14], et $_SESSION['results'][15]
		function update_results() {
			$hsum = 0;
			$lsum = 0;
			$res = 0;
			for ($i = 0; $i < 12; ++$i) {
				if ($_SESSION['results'][$i] !== -1) {
					if ($i < 5) {
						$hsum = $hsum + $_SESSION['results'][$i];
					} else {
						$lsum = $lsum + $_SESSION['results'][$i];
					}
				}
			}
			$res = $hsum + $lsum;
			$_SESSION['results'][13] = $hsum;
			$_SESSION['results'][14] = $lsum;
			$_SESSION['results'][15] = $res;
		}
		
    next_turn();
    $de1 = $_SESSION['de1'];
    $de2 = $_SESSION['de2'];
    $de3 = $_SESSION['de3'];
    $de4 = $_SESSION['de4'];
    $de5 = $_SESSION['de5'];
    $dice_tab = array($de1, $de2, $de3, $de4, $de5);
    $value_bouton1 = calcul('bouton1', $dice_tab);
    $value_bouton2 = calcul('bouton2', $dice_tab);
    $value_bouton3 = calcul('bouton3', $dice_tab);
    $value_bouton4 = calcul('bouton4', $dice_tab);
    $value_bouton5 = calcul('bouton5', $dice_tab);
    $value_bouton6 = calcul('bouton6', $dice_tab);
    $value_boutonbrelan = calcul('boutonbrelan', $dice_tab);
    $value_boutoncarre = calcul('boutoncarre', $dice_tab);
    $value_boutonfull = calcul('boutonfull', $dice_tab);
    $value_boutonpsuite = calcul('boutonpsuite', $dice_tab);
    $value_boutongsuite = calcul('boutongsuite', $dice_tab);
    $value_boutonyahtzee = calcul('boutonyahtzee', $dice_tab);
    $value_boutonchance = calcul('boutonchance', $dice_tab);
    update_all_dice($dice_tab);
		update_results();
    $result13 = $_SESSION['results'][13];
    $result14 = $_SESSION['results'][14];
    $result15 = $_SESSION['results'][15];
    $line = "
    <form method=\"post\" action=\"\">
      <table>
        <thead>
          <tr>
          <th>Section haute</th>
          <th>Section basse</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class=\"td\" ><input value=\"As\" name=\"bouton1\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text1', ".$value_bouton1.")\" onmouseout=\"clearbox('text1')\">
              <input name=\"text1\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Brelan\" name=\"boutonbrelan\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textbrelan', ".$value_boutonbrelan.")\" onmouseout=\"clearbox('textbrelan')\">
              <input name=\"textbrelan\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Deux\" name=\"bouton2\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text2', ".$value_bouton2.")\" onmouseout=\"clearbox('text2')\">
                <input name=\"text2\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Carre\" name=\"boutoncarre\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textcarre', ".$value_boutoncarre.")\" onmouseout=\"clearbox('textcarre')\">
                <input name=\"textcarre\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Trois\" name=\"bouton3\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text3', ".$value_bouton3.")\" onmouseout=\"clearbox('text3')\">
                <input name=\"text3\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Full\" name=\"boutonfull\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textfull', ".$value_boutonfull.")\" onmouseout=\"clearbox('textfull')\">
                <input name=\"textfull\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Quatre\" name=\"bouton4\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text4', ".$value_bouton4.")\" onmouseout=\"clearbox('text4')\">
                <input name=\"text4\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Petite suite\" name=\"boutonpsuite\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textpsuite', ".$value_boutonpsuite.")\" onmouseout=\"clearbox('textpsuite')\">
                <input name=\"textpsuite\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Cinq\" name=\"bouton5\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text5', ".$value_bouton5.")\" onmouseout=\"clearbox('text5')\">
                <input name=\"text5\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Grande suite\" name=\"boutongsuite\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textgsuite', ".$value_boutongsuite.")\" onmouseout=\"clearbox('textgsuite')\">
                <input name=\"textgsuite\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Six\" name=\"bouton6\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text6', ".$value_bouton6.")\" onmouseout=\"clearbox('text6')\">
                <input name=\"text6\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Yahtzee\" name=\"boutonyahtzee\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textyahtzee', ".$value_boutonyahtzee.")\" onmouseout=\"clearbox('textyahtzee')\">
                <input name=\"textyahtzee\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><label>Total section haute</label>
                <input name=\"textsectionh\" type=\"text\" class=\"txtbox\" value=\"$result13\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Chance\" name=\"boutonchance\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textchance', ".$value_boutonchance.")\" onmouseout=\"clearbox('textchance')\">
                <input name=\"textchance\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ></td>
            <td class=\"td\" ><label>Total section basse </label><input name=\"textsectionl\" type=\"text\" class=\"txtbox\" value=\"$result14\" disabled=\"true\"></td>
          </tr>
          <tr id=\"tr1\">
            <td></td>
            <td align=\"center\" id=\"td1\"><label>Total </label><input name=\"texttot\" type=\"text\" class=\"txtbox1\" value=\"$result15\" disabled=\"true\"></td>
          </tr>
        </tbody>
      </table>
      <br/>
    </form>
    <script type=\"text/javascript\" src=\"yahtzee.js\"></script>
    "; 
    echo "$line";
    echo "<form action = '' method='post'>";
    echo "<div class='affichage_des'>";
    print_all_dice();
    print_throw_button($_SESSION['tour']);
    $_SESSION['tour'] = $_SESSION['tour'] - 1;
    echo "</div>";
    echo "</form>";
  }
?>

