<?PHP
session_start();
include('connexion.php');

if ($_SESSION["id"] != "")
{
	if ($_GET["page"] == "chat")
	{
		if ($_GET["get"] == "lobby")
		{
			$req = $mysqli->query("SELECT `chat_text` ,`user_login` FROM `chat` INNER JOIN `user` ON `chat_user_id` = `user_id` WHERE `chat_game_id` = '0' ORDER BY `chat_id` DESC");
		}
		else if ($_GET["get"] == "game")
		{
			$req = $mysqli->query("SELECT `chat_text`, `user_login` FROM `chat` INNER JOIN `user` ON `chat_user_id` = `user_id` WHERE `chat_game_id` = ".$_SESSION['game_id']." ORDER BY `chat_id` DESC");
		}
		else
		{
			$req = $mysqli->query("SELECT 'error' as 'chat_text'");
		}
		while ($row = $req->fetch_array())
		{
			echo "<b>".$row["user_login"]."</b> : ".$row["chat_text"]."<br />";
		}
	}
	else if (trim($_POST["text"]) != "")
	{
		$stmt = $mysqli->prepare("INSERT INTO `chat` (`chat_user_id`, `chat_game_id`, `chat_text`) VALUES (?, ?, ?)");
		$stmt->bind_param("sds", $_SESSION["id"], $_SESSION['game_id'], trim(addslashes($_POST["text"])));
		$stmt->execute();
	}
	else if ($_GET["page"] == "lobby")
	{
		$query = $mysqli->query("SELECT `game_id`, `user_login` FROM `game` INNER JOIN `user` ON `game_user_id1` = `user_id` WHERE `game_lock` = '0'");
		while ($row = $query->fetch_array(MYSQLI_ASSOC))
		{
			echo "<form method='POST' action='game.php'>
					<input type='hidden' name='join' value='".$row['game_id']."'>
					<li>parti de ".$row['user_login']." <input type='submit' value='rejoindre'</li></form>";
		}
	}
}
?>