<?PHP
session_start();
include('connexion.php');

if ($_SESSION["id"] == "")
{
	header("location ../index.php");
}
?>
<!doctype html>
<html>
<header>
	<title>chat</title>
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
	function charge()
	{
		$("#chat").load("req_chat.php?get");
	}
	setInterval(charge,100);
	</script>
</header>
<body>
<div id="chat">
</div>
</html>