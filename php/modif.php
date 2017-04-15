<?PHP
session_start();
include('connexion.php');

if ($_POST["submit"] == "OK" && $_POST["login"] != "" && $_POST["oldpw"] != "" && $_POST["newpw"] != "")
{
	;
	$stmt = $mysqli->prepare("UPDATE `user` SET `user_pass`= ? WHERE `user_login` = ? AND `user_pass` = ?");
	$stmt->bind_param("sss", hash("whirlpool", $_POST["newpw"]), $_POST["login"], hash("whirlpool", $_POST["oldpw"]));
	$stmt->execute();
	if ($mysqli->affected_rows == 0)
	{
		header("location: ../modif.html");
		return;
	}
	header("location: ../index.php");
	return;
}
else
{
	header("location: ../modif.html");
}
?>