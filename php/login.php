<?PHP
session_start();
require_once('../class/App.class.php');
include('connexion.php');

if ($_SESSION["id"] == "")
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
<html>
<link rel='stylesheet' type='text/css' href='../css/style.css'></link>
<script src='../js/jquery-3.2.1.min.js'></script>
<body>
<script>
function mapPutPixel(x, y, color) {
	str = "#line"+ y + " th:nth-child(" + x + ")";
	console.log(str);
    $(str).css('background', color);
}

    function moveShip(){

    }

    const DOWN = 0;
    const LEFT = 1;
    const UP = 2;
    const RIGHT = 3;
    $(document).ready(function() {

        function eraseShip(x, y, model) {
            x+=1;
            for (i = 0; i < model.length; i++) {
                for (j = 0; j < model[i].length; j++) {
                   mapPutPixel(x - Math.floor((model[0].length / 2)) + j, y - Math.floor((model.length / 2)) + i, '#eeeeee');
                }
            }
        }
        function drawShip(x, y, model, color, dir) {
            x+=1;
            if (dir == DOWN) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x - Math.floor((model[0].length / 2)) + j, y - Math.floor((model.length / 2)) + i, color);
                    }
                }
            }
            if (dir == UP) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x + Math.floor((model[0].length / 2)) - j, y + Math.floor((model.length / 2)) - i, color);
                    }
                }
            }
            if (dir == LEFT) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x + Math.floor((model.length / 2)) - i, y + Math.floor((model[0].length / 2)) - j, color);
                    }
                }
            }
            if (dir == RIGHT) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x - Math.floor((model.length / 2)) + i, y - Math.floor((model[0].length / 2)) + j, color);
                    }
                }
            }
        }

        model = new Array();
        model.push("###");
        model.push(" # ");
        model.push(" # ");

       // drawShip(1,3,model, 'blue', DOWN);
        //drawShip(5,3,model, 'blue', UP);
        //drawShip(9,3,model, 'blue', LEFT);
        //drawShip(14,3,model, 'blue', RIGHT);

        ship_coord = new Array();
        $.ajax({
            url:"action.php?action=getship",
            type:"get",
            success:function(msg){
                ship_coord = JSON.parse(msg);
                drawShip(14,3,model, 'blue', RIGHT);
                ship_coord['dir'] = DOWN;
                console.log("rpout", ship_coord, ship_coord['x']);
                drawShip(ship_coord['x'],ship_coord['y'],model, 'blue', ship_coord['dir']);
            }
        });

        $('#left_button').click(function(){
            eraseShip(ship_coord['x'], ship_coord['y'], model);
            ship_coord['dir'] = (ship_coord['dir'] + 3) % 4;
            drawShip(ship_coord['x'], ship_coord['y'], model, 'blue', ship_coord['dir']);
           /* $.get('test.php?move=left', function(data, status) {
                alert("data : " + data + "\nStatus" + status);
            })*/
        });

        $('#right_button').click(function(){
            eraseShip(ship_coord['x'], ship_coord['y'], model);
            ship_coord['dir'] = (ship_coord['dir'] + 1) % 4;
            drawShip(ship_coord['x'], ship_coord['y'], model, 'blue', ship_coord['dir']);
            /*$.get('test.php?move=right', function(data, status) {
                alert("data : " + data + "\nStatus" + status);
            })*/
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

function ecri()
{
	$.post("req_chat.php", { text: $("#msg").val()});
	$("#msg").val("");
}
</script>
<div id="stat">
<?php
echo "<h3>".$_SESSION["login"]." VS j2</h3>
<p>".$_SESSION["login"]."</p>
<lu>
	<li>nb ship : 5</li>
	<li>color red</li>
</ul>
<p>j2</p>
<lu>
	<li>nb ship : 5</li>
	<li>color blue</li>
</ul>
<h3>ship selectioner</h3>
<p>black pearl</p>
<lu>
	<li>cordoner x : 2</li>
	<li>cordoner y : 2</li>
	<li>pst coque : 10</li>
	<li>bouclier : 5</li>
	<li>puisanse moteur : 2</li>
	<li>vitese : 2</li>
</ul>
<p>BFG9000</p>
<ul>
	<li>porter cour : 2</li>
	<li>porter moy : 5</li>
	<li>poter long : 7</li>
	<li>dega : 4</li>
	<li>pp arme : 1</li>
</ul>";
?>
</div>
<div id="foot">
<div class="flex-container flex-column">
	<input id="up_button" class="up" type="submit" value="UP" name="move">
	<div class="flex-body flex-row">
		<input id ="left_button" class="left" type="submit" value="LEFT" name="move">
		<input id="right_button" type="submit" value="RIGHT" name="move">
	</div>
	<input id="down_button" type="submit" value="DOWN" name="move">
	</div>
<div id="div_chat">
	<iframe name='chat' src='chat.php' width="100%" height="100%"></iframe>
	<div id="div_text"><input type='text' id='msg' value="" align="right"/><input type='submit' id="chat_ok" onclick="ecri()" value='OK' /></div>
</div>
</div>
</body>
</html>
