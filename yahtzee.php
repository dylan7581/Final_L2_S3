<html>
	<head>
		<title>Yahtzee</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="yahtzee.css"/>
	</head>
	<body>
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
						<td id="td" ><input value="As" name="button1" type="submit" class="button">
								<input name="text1" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Brelan" name="buttonbrelan" type="submit" class="button">
								<input name="textbrelan" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Deux" name="button2" type="submit" class="button">
								<input name="text2" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Carre" name="buttoncarre" type="submit" class="button">
								<input name="textcarre" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Trois" name="button3" type="submit" class="button">
								<input name="text3" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Full" name="buttonfull" type="submit" class="button">
								<input name="textfull" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Quatre" name="button4" type="submit" class="button">
								<input name="text4" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Petite suite" name="buttonpsuite" type="submit" class="button">
								<input name="textpsuite" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Cinq" name="button5" type="submit" class="button">
								<input name="text5" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Grande suite" name="buttongsuite" type="submit" class="button">
								<input name="textgsuite" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><input value="Six" name="button6" type="submit" class="button">
								<input name="text6" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Yahtzee" name="buttonyahtzee" type="submit" class="button">
								<input name="textyahtzee" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ><label>Total section haute</label>
								<input name="textchance" type="text" class="txtbox" disabled="true"></td>
						<td id="td" ><input value="Chance" name="buttonchance" type="submit" class="button">
								<input name="textchance" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td id="td" ></td>
						<td id="td" ><label>Total section basse </label><input name="textchance" type="text" class="txtbox" disabled="true"></td>
					</tr>
					<tr>
						<td colspan="2" align="center" class="bas"><label>Total </label><input name="textchance" type="text" class="txtbox1" disabled="true"></td>
					</tr>
				</tbody>
			</table>

		  <input type="checkbox" name="d1"><label>Keep</label>
		  <input type="checkbox" name="d2"><label>Keep</label>
		  <input type="checkbox" name="d3"><label>Keep</label>
		  <input type="checkbox" name="d4"><label>Keep</label>
		  <input type="checkbox" name="d5"><label>Keep</label>
		  <input type="submit" name="lancer" value="lancer! (3)" class="button1">
		</form>
	</body>
</html>

<?php

?>