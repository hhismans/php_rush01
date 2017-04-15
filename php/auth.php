<?PHP
session_start();
include('connexion.php');
if (($_POST["login"] != "" && $_POST["passwd"] != "") || $_SESSION["login"] != "")
{
	$stmt = $mysqli->prepare("SELECT COUNT(`user_id`), `user_login`, `user_id` FROM `user` WHERE user_login=? AND user_pass=? GROUP BY `user_id`");
	$stmt->bind_param("ss", $_POST["login"], hash("whirlpool", $_POST["passwd"]));
	$stmt->execute();
	$stmt->bind_result($nb_ligne, $login, $id);
	$stmt->fetch();
	if ($nb_ligne == 1)
	{
		$_SESSION["login"] = $login;
		$_SESSION["id"] = $id;
		header("location: login.php");
		return;
	}
}
$_SESSION["login"] = "";
$_SESSION["id"] = "";
	echo "SELECT COUNT(`user_id`), `user_login`, `user_id` FROM `user` WHERE user_login=".$_POST["login"]." AND user_pass=".hash("whirlpool", $_POST["passwd"])." GROUP BY `user_id`<br />";
//header("location: ../index.php");
return;
?>