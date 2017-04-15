<?PHP
session_start();
include('connexion.php');

if ($_POST["submit"] == "OK" && $_POST["login"] != "" && $_POST["passwd"] != "")
{
	$stmt = $mysqli->prepare("SELECT COUNT(`user_id`) FROM `user` WHERE user_login=? AND user_pass=?");
	$stmt->bind_param("ss", $_POST["login"], hash("whirlpool", $_POST["passwd"]));
	$stmt->execute();
	$stmt->bind_result($nb_ligne);
	$stmt->fetch();
	if ($nb_ligne != 0)
	{
		header("location: ../create.html");
		return;
	}
	$stmt = "";
	$stmt = $mysqli->prepare("INSERT INTO `user` (`user_login`, `user_pass`) VALUES (?, ?)");
	$stmt->bind_param("ss", $_POST["login"], hash("whirlpool", $_POST["passwd"]));
	$stmt->execute();
	header("location: ../index.php");
	return;
}
else
{
	header("location: ../create.html");
}
?>