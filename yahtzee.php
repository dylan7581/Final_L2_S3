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
  if(isset($_POST['lancer']) === false) {
    // si l'un des boutons est appuyer, alors la valeur garder en mémoire est 
    //  mis stocker dans le tableau résultat et le bouton est désactiver pour les prochain tour.
    if (isset($_POST['bouton1']) === true) {$_SESSION['results'][0] = $_SESSION['tmp'][0]; $_SESSION['results'][13] += $_SESSION['tmp'][0]; $_SESSION['disabled'][0] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['bouton2']) === true) {$_SESSION['results'][1] = $_SESSION['tmp'][1]; $_SESSION['results'][13] += $_SESSION['tmp'][1]; $_SESSION['disabled'][1] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['bouton3']) === true) {$_SESSION['results'][2] = $_SESSION['tmp'][2]; $_SESSION['results'][13] += $_SESSION['tmp'][2]; $_SESSION['disabled'][2] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['bouton4']) === true) {$_SESSION['results'][3] = $_SESSION['tmp'][3]; $_SESSION['results'][13] += $_SESSION['tmp'][3]; $_SESSION['disabled'][3] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['bouton5']) === true) {$_SESSION['results'][4] = $_SESSION['tmp'][4]; $_SESSION['results'][13] += $_SESSION['tmp'][4]; $_SESSION['disabled'][4] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['bouton6']) === true) {$_SESSION['results'][5] = $_SESSION['tmp'][5]; $_SESSION['results'][13] += $_SESSION['tmp'][5]; $_SESSION['disabled'][5] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['boutonbrelan']) === true) {$_SESSION['results'][6] = $_SESSION['tmp'][6]; $_SESSION['results'][14] += $_SESSION['tmp'][6]; $_SESSION['disabled'][6] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['boutoncarre']) === true) {$_SESSION['results'][7] = $_SESSION['tmp'][7]; $_SESSION['results'][14] += $_SESSION['tmp'][7]; $_SESSION['disabled'][7] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['boutonfull']) === true) {$_SESSION['results'][8] = $_SESSION['tmp'][8]; $_SESSION['results'][14] += $_SESSION['tmp'][8]; $_SESSION['disabled'][8] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['boutonpsuite']) === true) {$_SESSION['results'][9] = $_SESSION['tmp'][9]; $_SESSION['results'][14] += $_SESSION['tmp'][9]; $_SESSION['disabled'][9] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['boutongsuite']) === true) {$_SESSION['results'][10] = $_SESSION['tmp'][10]; $_SESSION['results'][14] += $_SESSION['tmp'][10]; $_SESSION['disabled'][10] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['boutonyahtzee']) === true) {$_SESSION['results'][11] = $_SESSION['tmp'][11]; $_SESSION['results'][14] += $_SESSION['tmp'][11]; $_SESSION['disabled'][11] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    if (isset($_POST['boutonchance']) === true) {$_SESSION['results'][12] = $_SESSION['tmp'][12]; $_SESSION['results'][14] += $_SESSION['tmp'][12]; $_SESSION['disabled'][12] = 'disabled'; $_SESSION['cases'] = $_SESSION['cases'] - 1;}
    include("init.php");
  } else {
		
//--- Fonctions utilisées -------------------------------------------------------------------------------------
		
    //  print_dice : Affiche le dé correspondant à la valeur de la variable
    //    $_SESSION['de[n]'] où [n] est le chiffre correspondant au dé à afficher.
    //    Affiche "Erreur d'affichage" et met fin à la session en cas d'erreur.
    function print_dice($n, $c) {
      if ($n >= 1 && $n <= 6) {
        echo "<div>";
        echo "<img src='des/De$n.png' alt='Dé $n' name='img_de$c' onclick=\"image_check('d$c', 'img_de$c')\">";
        echo "<br/>";
        echo "<input type='checkbox' name='d$c' onclick=\"checkbox('d$c', 'img_de$c')\"><label>Garder</label>";
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
    //    que l'utilisateur a choisi de ne pas garder.
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
      $tab2 = array_values($tab2);
      $i = 0;
      while ($i < count($tab2) - 1 && $n1 < $n) {
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

    //  calcul : fonction qui calcul, pour un bouton donné $button et un tableau représentant
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
          if (is_n_identical_dice(3, $dice_tab_occ) === true 
							&& is_n_identical_dice(2, $dice_tab_occ) === true) {
            return 25;
          } else {
            return "";
          }
          break;
        case 'boutonpsuite':
          if (is_n_suite(4, $dice_tab) === true) {
            return 30;
          } else {
            return "";
          }
          break;
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
//--- Programme principal -------------------------------------------------------------------------------------

		if (isset($_POST['lancer']) === true) {
    	next_turn();
		}
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

    //On stocke les résultats des calculs dans le tableau qui garde en mémoire.
    $_SESSION['tmp'] = [$value_bouton1, $value_bouton2, $value_bouton3, $value_bouton4,
                       $value_bouton5, $value_bouton6, $value_boutonbrelan, $value_boutoncarre,
                       $value_boutonfull, $value_boutonpsuite, $value_boutongsuite, $value_boutonyahtzee,
                       $value_boutonchance];
    //Variable qui stocke la chaine de caractère 'disabled' si le bouton a déjà 
    //  était cliquer, ou '' sinon.
    $desact1 = $_SESSION['disabled'][0];
    $desact2 = $_SESSION['disabled'][1];
    $desact3 = $_SESSION['disabled'][2];
    $desact4 = $_SESSION['disabled'][3];
    $desact5 = $_SESSION['disabled'][4];
    $desact6 = $_SESSION['disabled'][5];
    $desactbrelan = $_SESSION['disabled'][6];
    $desactcarre = $_SESSION['disabled'][7];
    $desactfull = $_SESSION['disabled'][8];
    $desactpsuite = $_SESSION['disabled'][9];
    $desactgsuite = $_SESSION['disabled'][10];
    $desactyahtzee = $_SESSION['disabled'][11];
    $desactchance = $_SESSION['disabled'][12];


    //Variables qui stocke le résultat des totals.
    $result13 = $_SESSION['results'][13];
    $result14 = $_SESSION['results'][14];
    $result15 = $_SESSION['results'][13] + $_SESSION['results'][14];
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
            <td class=\"td\" ><input value=\"As\" name=\"bouton1\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text1', ".$value_bouton1.")\" onmouseout=\"clearbox('text1')\" $desact1>
              <input name=\"text1\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Brelan\" name=\"boutonbrelan\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textbrelan', ".$value_boutonbrelan.")\" onmouseout=\"clearbox('textbrelan')\" $desactbrelan>
              <input name=\"textbrelan\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Deux\" name=\"bouton2\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text2', ".$value_bouton2.")\" onmouseout=\"clearbox('text2')\" $desact2>
                <input name=\"text2\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Carre\" name=\"boutoncarre\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textcarre', ".$value_boutoncarre.")\" onmouseout=\"clearbox('textcarre')\" $desactcarre>
                <input name=\"textcarre\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Trois\" name=\"bouton3\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text3', ".$value_bouton3.")\" onmouseout=\"clearbox('text3')\" $desact3>
                <input name=\"text3\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Full\" name=\"boutonfull\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textfull', ".$value_boutonfull.")\" onmouseout=\"clearbox('textfull')\" $desactfull>
                <input name=\"textfull\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Quatre\" name=\"bouton4\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text4', ".$value_bouton4.")\" onmouseout=\"clearbox('text4')\" $desact4>
                <input name=\"text4\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Petite suite\" name=\"boutonpsuite\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textpsuite', ".$value_boutonpsuite.")\" onmouseout=\"clearbox('textpsuite')\" $desactpsuite>
                <input name=\"textpsuite\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Cinq\" name=\"bouton5\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text5', ".$value_bouton5.")\" onmouseout=\"clearbox('text5')\" $desact5>
                <input name=\"text5\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Grande suite\" name=\"boutongsuite\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textgsuite', ".$value_boutongsuite.")\" onmouseout=\"clearbox('textgsuite')\" $desactgsuite>
                <input name=\"textgsuite\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><input value=\"Six\" name=\"bouton6\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('text6', ".$value_bouton6.")\" onmouseout=\"clearbox('text6')\" $desact6>
                <input name=\"text6\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Yahtzee\" name=\"boutonyahtzee\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textyahtzee', ".$value_boutonyahtzee.")\" onmouseout=\"clearbox('textyahtzee')\" $desactyahtzee>
                <input name=\"textyahtzee\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
          </tr>
          <tr>
            <td class=\"td\" ><label>Total section haute</label>
                <input name=\"textsectionh\" type=\"text\" class=\"txtbox\" value=\"$result13\" disabled=\"true\"></td>
            <td class=\"td\" ><input value=\"Chance\" name=\"boutonchance\" type=\"submit\" class=\"button\" onmouseover=\"value_survol('textchance', ".$value_boutonchance.")\" onmouseout=\"clearbox('textchance')\" $desactchance>
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
    //Décrémente le nombre de relancement.
    if ($_SESSION['tour'] != 0) {
      $_SESSION['tour'] = $_SESSION['tour'] - 1;
    }
    echo "</div>";
    echo "</form>";
  }
?>

