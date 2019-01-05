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
		<h2>Bravo, tu as gagné avec un total de <?php echo $_SESSION['results'][13] + $_SESSION['results'][14];?> points</h2>
		<form method="post" action="yahtzee.php" class="formr">
			<input value="Recommencer" type="submit" class="buttonr">
		</form>
  </body>
</html>

<?php
	session_destroy();
?>