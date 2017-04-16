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
	$("#chat").load("req_php.php?page=chat&get=" + window.parent.document.title);
}
setInterval(charge,200);
</script>
<div id="chat">
</div>