<?PHP
session_start();
include('connexion.php');

if ($_SESSION["id"] != "")
{
	if (isset($_GET["get"]))
	{
		$req = $mysqli->query("SELECT `chat_text` FROM `chat` ORDER BY `chat_id` DESC");
		while ($row = $req->fetch_array())
		{
			echo $row["chat_text"]."<br />";
		}
	}
	else if (trim($_POST["text"]) != "")
	{
		$req = $mysqli->query("SELECT `chat_text` FROM `chat`");
		$stmt = $mysqli->prepare("INSERT INTO `chat` (`chat_user_id`, `chat_game_id`, `chat_text`) VALUES ('1', '1', ?)");
		$stmt->bind_param("s", trim(addslashes($_POST["text"])));
		$stmt->execute();
	}
}
?>