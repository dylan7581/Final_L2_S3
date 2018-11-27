<?php
  //Init.php : Initialise les variables de session nécessaires et les dés au
  //  premier tour du jeu.
  session_start();
  
  //Nombre de cases qui sont encore disponibles.
  $_SESSION['cases'] = 13;
  //Nombre de fois que l'utilisateur peut appuyer sur le bouton "Lancer!" après
  //  avoir démarré la partie.
  $_SESSION['tour'] = 2;
  
  //Initialisation des dés
  $_SESSION['de1'] = rand(1, 6);
  $_SESSION['de2'] = rand(1, 6);
  $_SESSION['de3'] = rand(1, 6);
  $_SESSION['de4'] = rand(1, 6);
  $_SESSION['de5'] = rand(1, 6);

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
