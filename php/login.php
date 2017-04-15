<?PHP
session_start();
require_once('../class/App.class.php');
include('connexion.php');

if ($_SESSION["id"] != "")
{
	echo "<html>
	    <linK rel='stylesheet' type='text/css' href='../css/style.css'>
	    <script src='../js/jquery-3.2.1.min.js'></script>
		<body>
		<center><h1>bonjour ".$_SESSION["login"]."<h1></center>
		<iframe name='chat' src='chat.php' width='100%' height='550px'></iframe>
		<iframe name='speak' src='speak.php' width='100%' height='50px'></iframe>";

}
else
{
	header("location: ../index.php");
	return;
}
?>

<?php
	//$var = json_decode(file_get_contents("data.json"));
    //$ship = new miniship(array('dataObj' => $var));
	$_SESSION['app'] = new App(array());
	$_SESSION['app']->dumpHtml();
?>
<script>

function mapPutPixel(x, y, color) {
	str = "#line"+ y + " th:nth-child(" + x + ")";
	console.log(str);
    $(str).css('background', color);
}

function moveShip(){

}

$(document).ready(function(){
    ship_coord = new Array();
    $.ajax({
        url:"action.php?action=getship",
        type:"get",
        success:function(msg){
            ship_coord = JSON.parse(msg);
            console.log(msg);
        }
    });

    $('#left_button').click(function(){
		$.get('test.php?move=left', function(data, status) {
			alert("data : " + data + "\nStatus" + status);
		})
	});

	$('#right_button').click(function(){
		$.get('test.php?move=right', function(data, status) {
			alert("data : " + data + "\nStatus" + status);
		})
	});

	$('#up_button').click(function(){
		$.get('test.php?move=up', function(data, status) {
			alert("data : " + data + "\nStatus" + status);
		})
	});

	$('#down_button').click(function(){
		$.get('test.php?move=down', function(data, status) {
			alert("data : " + data + "\nStatus" + status);
		})
	});

	$('#my-span').click(function(){
        console.log(ship_coord);
	});
});
</script>
<span id="my-span">prout</span>

<div class="flex-container flex-column" style="height:100px">
	<input id="up_button" class="up" type="submit" value="UP" name="move">
	<div class="flex-body flex-row">
		<input id ="left_button" class="left" type="submit" value="LEFT" name="move">
		<input id="right_button" type="submit" value="RIGHT" name="move">
	</div>
	<input id="down_button" type="submit" value="DOWN" name="move">
</div>
</body>
</html>
