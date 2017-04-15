<?PHP
session_start();
include('connexion.php');

if ($_SESSION["id"] == "")
{
	header("location ../index.php");
}
?>
<script src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
function charge()
{
	$("#chat").load("req_chat.php?get");
}
setInterval(charge,100);
</script>
<div id="chat">
</div>