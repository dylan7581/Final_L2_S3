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
			<br>
			<div class="affichage_des">
				<div>
				  <img src="des/De1.png">
				  <br>
		  		<input type="checkbox" disabled="true" name="d1"><label>Keep</label>
			  </div>
			  <div>
				  <img src="des/De2.png">
				  <br>
				  <input type="checkbox" disabled="true" name="d2"><label>Keep</label>
			  </div>
			  <div>
				  <img src="des/De3.png">
				  <br>
				  <input type="checkbox" disabled="true" name="d3"><label>Keep</label>
				</div>
				<div>
				  <img src="des/De4.png">
				  <br>
				  <input type="checkbox" disabled="true" name="d4"><label>Keep</label>
				</div>
				<div>
				  <img src="des/De5.png">
				  <br>
				  <input type="checkbox" disabled="true" name="d5"><label>Keep</label>
				</div>
			  <input type="submit" name="lancer" value="lancer! (3)" class="button1">
		  </div>
		</form>
	</body>
</html>

<?php

?>