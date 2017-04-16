<?php
	session_start();
	include('php/connexion.php');
	$_SESSION["game_id"] = "";
	$_SESSION["login"] = "";
	$_SESSION["id"] = "";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<table style="border:1px solid gray">
	<tr>
		<td><center>connextion</center></td>
	</tr>
	<tr>
		<td>
		<form method="POST" action="php/auth.php">
			Identifiant: <input type="text" name="login" value=""/>
			Mot de passe: <input type="text" name="passwd" value=""/>
			<br />
			<center><input type="submit" name="submit" value="OK"/></center>
		</form>
		</td>
	</tr>
</table>
<br />
<a href="create.html" style="padding-left: 80px">créer un compte</a>
<a href="modif.html" style="padding-left: 80px">modifier son mot de passe</a>
</body>
</html>