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
		<form method="post" action="">
			<table>
				<thead>
					<tr>
						<th>Section haute</th>
						<th>Section basse</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td id="td" ><input value="As" name="bouton1" type="submit" class="button">
								<input name="text1" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Brelan" name="boutonbrelan" type="submit" class="button">
								<input name="textbrelan" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Deux" name="bouton2" type="submit" class="button">
								<input name="text2" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Carre" name="boutoncarre" type="submit" class="button">
								<input name="textcarre" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Trois" name="bouton3" type="submit" class="button">
								<input name="text3" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Full" name="boutonfull" type="submit" class="button">
								<input name="textfull" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Quatre" name="bouton4" type="submit" class="button">
								<input name="text4" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Petite suite" name="boutonpsuite" type="submit" class="button">
								<input name="textpsuite" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Cinq" name="bouton5" type="submit" class="button">
								<input name="text5" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Grande suite" name="boutongsuite" type="submit" class="button">
								<input name="textgsuite" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Six" name="bouton6" type="submit" class="button">
								<input name="text6" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Yahtzee" name="boutonyahtzee" type="submit" class="button">
								<input name="textyahtzee" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><label>Total section haute</label>
								<input name="textchance" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Chance" name="boutonchance" type="submit" class="button">
								<input name="textchance" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ></td>
						<td id="td" ><label>Total section basse </label><input name="textchance" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr class="tr1">
						<td></td>
						<td align="center" id="td1"><label>Total </label><input name="textchance" type="text" class="txtbox1" disabled="true"></td>
					</tr>
				</tbody>
			</table>
			<br/>
		</form>
	</body>
</html>

<?php
  if(isset($_POST['lancer']) === false) {
    include("init.php");
  }
  if(isset($_POST['lancer']) === true) {
    
    //print_dice : Affiche le dé correspondant à la valeur de la variable
    //  $_SESSION['de[n]'] où [n] est le chiffre correspondant au dé à afficher.
    //  Affiche "Erreur d'affichage" et met fin à la session en cas d'erreur.
    function print_dice($n, $c) {
      if ($n >= 1 && $n <= 6) {
        echo "<div>";
        echo "<img src='des/De$n.png'>";
        echo "<br/>";
        echo "<input type='checkbox' name='d$c'><label>Garder</label>";
        echo "</div>";
      } else {
        echo "<p>Erreur d'affichage</p>";
        session_destroy();
      }
    }

    //print_all_dice : Affiche tous les dés initialisés. Affiche un message d'erreur
    //  et met fin à la session en cas d'erreur sur un des dés.
    function print_all_dice(){
      print_dice($_SESSION['de1'], 1);
      print_dice($_SESSION['de2'], 2);
      print_dice($_SESSION['de3'], 3);
      print_dice($_SESSION['de4'], 4);
      print_dice($_SESSION['de5'], 5);
    }

    //print_throw_button : Affiche le bouton "Lancer!" suivi de nombre de coups
    //  '$n' qu'il reste à l'utilisateur pour ce tour. Affiche un message d'erreur
    //  et met fin à la session si $n < 0 ou $n > 3
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

    //next_turn : Attribue aléatoirement une valeur entre 1 et 6 à chaque dé
    //  que l'utilisateur a choisi de ne pas garder puis réduit le nombre de
    //  coups qu'il/elle peut jouer. 
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
    
    echo "<form action = '' method='post'>";
    echo "<div class='affichage_des'>";
    next_turn();
    print_all_dice();
    print_throw_button($_SESSION['tour']);
    $_SESSION['tour'] = $_SESSION['tour'] - 1;
    echo "</div>";
    echo "</form>";
  }
?>
