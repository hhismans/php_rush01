<?PHP
session_start();
include('connexion.php');

if ($_SESSION["id"] != "")
{
	echo "<html>
		<body>
		<center><h1>bonjour ".$_SESSION["login"]."<h1></center>
		<iframe name='chat' src='chat.php' width='100%' height='550px'></iframe>
		<iframe name='speak' src='speak.php' width='100%' height='50px'></iframe>
		</body>
		</html>";
}
else
{
	header("location: ../index.php");
	return;
}
?>