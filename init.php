<?php
  //Init.php : Initialise les variables de session nécessaires et les dés au
  //  premier tour du jeu.
  session_start();
  
  //Nombre de cases qui sont encore disponibles.
  $_SESSION['cases'] = 13;

  //Nombre de fois que l'utilisateur peut appuyer sur le bouton "Lancer!" après
  //  avoir démarré la partie.
  $_SESSION['tour'] = 2;
  
  $_SESSION['de1'] = 0;
  $_SESSION['de2'] = 0;
  $_SESSION['de3'] = 0;
  $_SESSION['de4'] = 0;
  $_SESSION['de5'] = 0;

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
              <td class=\"td\" ><input value=\"As\" name=\"bouton1\" type=\"submit\" class=\"button\">
                <input name=\"text1\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Brelan\" name=\"boutonbrelan\" type=\"submit\" class=\"button\">
                <input name=\"textbrelan\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Deux\" name=\"bouton2\" type=\"submit\" class=\"button\">
                  <input name=\"text2\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Carre\" name=\"boutoncarre\" type=\"submit\" class=\"button\">
                  <input name=\"textcarre\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Trois\" name=\"bouton3\" type=\"submit\" class=\"button\">
                  <input name=\"text3\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Full\" name=\"boutonfull\" type=\"submit\" class=\"button\">
                  <input name=\"textfull\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Quatre\" name=\"bouton4\" type=\"submit\" class=\"button\">
                  <input name=\"text4\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Petite suite\" name=\"boutonpsuite\" type=\"submit\" class=\"button\">
                  <input name=\"textpsuite\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Cinq\" name=\"bouton5\" type=\"submit\" class=\"button\">
                  <input name=\"text5\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Grande suite\" name=\"boutongsuite\" type=\"submit\" class=\"button\">
                  <input name=\"textgsuite\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><input value=\"Six\" name=\"bouton6\" type=\"submit\" class=\"button\">
                  <input name=\"text6\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Yahtzee\" name=\"boutonyahtzee\" type=\"submit\" class=\"button\">
                  <input name=\"textyahtzee\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ><label>Total section haute</label>
                  <input name=\"textsectionh\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
              <td class=\"td\" ><input value=\"Chance\" name=\"boutonchance\" type=\"submit\" class=\"button\">
                  <input name=\"textchance\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr>
              <td class=\"td\" ></td>
              <td class=\"td\" ><label>Total section basse </label><input name=\"textsectionl\" type=\"text\" class=\"txtbox\" disabled=\"true\"></td>
            </tr>
            <tr id=\"tr1\">
              <td></td>
              <td align=\"center\" id=\"td1\"><label>Total </label><input name=\"texttot\" type=\"text\" class=\"txtbox1\" disabled=\"true\"></td>
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