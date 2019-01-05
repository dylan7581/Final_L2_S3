<?php
  //Init.php : Initialise les variables de session nécessaires et les dés au
  //  premier tour du jeu et après avoir appuyer sur l'un des boutons.
  session_start();
  //Initialise le jeu.
  if (isset($_POST['bouton1']) === false &&
      isset($_POST['bouton2']) === false &&
      isset($_POST['bouton3']) === false &&
      isset($_POST['bouton4']) === false &&
      isset($_POST['bouton5']) === false &&
      isset($_POST['bouton6']) === false &&
      isset($_POST['boutonbrelan']) === false &&
      isset($_POST['boutoncarre']) === false &&
      isset($_POST['boutonfull']) === false &&
      isset($_POST['boutonpsuite']) === false &&
      isset($_POST['boutongsuite']) === false &&
      isset($_POST['boutonyahtzee']) === false &&
      isset($_POST['boutonchance']) === false) {

    //Garde en mémoire les calculs fait pour chaque boutons.
    $_SESSION['tmp'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    //Nombre de cases qui sont encore disponibles.
    $_SESSION['cases'] = 13;
    
    //Initialisation du tableau des résultats.
    $_SESSION['results'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    //Initialisation du tableau pour desactiver boutons.
    $_SESSION['disabled'] = ['', '', '', '', '', '', '', '', '', '', '', '', ''];
}
//Nombre de boutons encore actif.
  if ($_SESSION['cases'] !== 0) {
    //Nombre de fois que l'utilisateur peut appuyer sur le bouton "Lancer!" après
    //  avoir démarré la partie.
    $_SESSION['tour'] = 2;
  } else {
    header('Location: win.php');
    exit();
  }
  $result13 = $_SESSION['results'][13];
  $result14 = $_SESSION['results'][14];
  $result15 = $_SESSION['results'][13] + $_SESSION['results'][14];
  //Initialisation des parties hautes et basses de l'interface du jeu.
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
              <td class=\"td\" ><input value=\"As\" name=\"bouton1\" type=\"submit\" class=\"button\" disabled='true'>
                <input name=\"text1\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Brelan\" name=\"boutonbrelan\" type=\"submit\" class=\"button\" disabled='true'>
                <input name=\"textbrelan\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Deux\" name=\"bouton2\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"text2\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Carre\" name=\"boutoncarre\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"textcarre\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Trois\" name=\"bouton3\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"text3\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Full\" name=\"boutonfull\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"textfull\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Quatre\" name=\"bouton4\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"text4\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Petite suite\" name=\"boutonpsuite\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"textpsuite\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Cinq\" name=\"bouton5\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"text5\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Grande suite\" name=\"boutongsuite\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"textgsuite\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Six\" name=\"bouton6\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"text6\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Yahtzee\" name=\"boutonyahtzee\" type=\"submit\" class=\"button\" disabled='true'>
                  <input name=\"textyahtzee\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><label>Total section haute</label>
                  <input name=\"textsectionh\" type=\"text\" class=\"txtbox\" value=\"$result13\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Chance\" name=\"boutonchance\" type=\"submit\" class=\"button\" disabled='true'>
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
  echo $line;
  //Affichage des dés au premier tour. L'utilisateur ne peut pas garder les dés
  //  à ce moment. 
  echo "<form action='' method='post'>";
  echo "<div class='affichage_des'>";
  echo "<div>";
  echo "<img src='des/De1.png'>";
  echo "<br>";
  echo "</div>";
  echo "<div>";
  echo "<img src='des/De2.png'>";
  echo "<br>";
  echo "</div>";
  echo "<div>";
  echo "<img src='des/De3.png'>";
  echo "<br>";
  echo "</div>";
  echo "<div>";
  echo "<img src='des/De4.png'>";
  echo "<br>";
  echo "</div>";
  echo "<div>";
  echo "<img src='des/De5.png'>";
  echo "<br>";
  echo "</div>";
  echo "<input type='submit' name='lancer' value='Lancer! (3)' class='button1'>";
  echo "</div>";
  echo "</form>";

?> 
