<?PHP
session_start();
include('connexion.php');

if ($_SESSION["id"] == "")
{
	header("location: ../index.php");
	return;
}
echo $_SESSION["game_id"]."btebtrbntrtnbrn";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>lobby</title>
<link rel='stylesheet' type='text/css' href='../css/style.css'></link>
<script src='../js/jquery-3.2.1.min.js'></script>
<script type="text/javascript">
function ecri()
{
	$.post("req_php.php", { text: $("#msg").val(), page: document.title});
	$("#msg").val("");
}

$(document).keypress(function (e) {
                if (e.which == 13 || event.keyCode == 13) {
                    ecri();
                }
            });

function charge()
{
	$("#game").load("req_php.php?page=lobby&get=" + window.parent.document.title);
}
setInterval(charge,300);
</script>
</head>
<body>
<center><h1>lobby</h1></center>
<div id="lst_game">
<form method="POST" action="game.php">
<input type="hidden" name="create">
<center><input type="submit" value="creer une parti"/></center>
</form>
<h3>list des parti</h3>
<ul id="game">
</ul>
</div>
<iframe name='chat_lobby' src='chat.php' width="30%" height="80%"></iframe>
<div id="lobby_div_text"><input type='text' id='msg' value=""/><input type='submit' id="chat_ok" onclick="ecri()" value='OK' /></div>
</body>
</html>