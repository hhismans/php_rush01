<?PHP
session_start();

if ($_SESSION["id"] == "")
{
	header("location ../index.php");
}
?>
<html>
<header>
<script src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
function ecri()
{
	//$("#msg").load("req_chat.php?set=" + $("#msg").val());
	$.post("req_chat.php", { text: $("#msg").val()});
	$("#msg").val("");
}
</script>
</header>
<body>		
<input type='text' id='msg' style='width:90%' value=""/><input type='submit' style='width:10%' onclick="ecri()" value='OK' />
</body>
</html>