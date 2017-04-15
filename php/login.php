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

        function eraseShip(x, y, model, dir) {
            x+=1;
            if (dir == DOWN) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x - Math.floor((model[0].length / 2)) + j, y - Math.floor((model.length / 2)) + i, '#eeeeee');
                    }
                }
            }
            if (dir == UP) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x + Math.floor((model[0].length / 2)) - j, y + Math.floor((model.length / 2)) - i, '#eeeeee');
                    }
                }
            }
            if (dir == LEFT) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x + Math.floor((model.length / 2)) - i, y + Math.floor((model[0].length / 2)) - j, '#eeeeee');
                    }
                }
            }
            if (dir == RIGHT) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x - Math.floor((model.length / 2)) + i, y - Math.floor((model[0].length / 2)) + j, '#eeeeee');
                    }
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

        {
        model = new Array();
        model.push(new Array());
        model[0].push("###########");
        model[0].push("###########");
        model[0].push("###########");
        model[0].push("   #####   ");
        model[0].push("   #####   ");
        model[0].push("   #####   ");
        model[0].push("   #####   ");
        model[0].push("   #####   ");
        model[0].push("   #####   ");
        model[0].push("   #####   ");
        model[0].push("  #######  ");
        model[0].push("  #######  ");
        model[0].push("  #######  ");
        model[0].push("  #######  ");
        model[0].push("  #######  ");
        model[0].push("  #######  ");

        model.push(new Array());
        model[1].push("###########");
        model[1].push("###########");
        model[1].push("###########");
        model[1].push("   #####   ");
        model[1].push("   #####   ");
        model[1].push("   #####   ");

        model.push(new Array());
        model[2].push("###########");
        model[2].push("###########");
        model[2].push("###########");
        model[2].push("   #####   ");
        model[2].push("   #####   ");
        model[2].push("   #####   ");} // model

        ships_data = new Array();
        $.ajax({
            url:"action.php?action=getship",
            type:"get",
            success:function(msg){
                ships_data = JSON.parse(msg);
               console.log ("SHIP COORD ",ships_data);
                //ships_data['dir'] = DOWN;
                //console.log("SHIP COORD", ships_data, ships_data['x'], ships_data['type']);
                drawShip(ships_data['x'],ships_data['y'], model[ships_data['type']], 'blue', ships_data['dir']);
            }
        });

        $('#left_button').click(function(){
            console.log('left click');
            eraseShip(ships_data['x'], ships_data['y'],  model[ships_data['type']] ,ships_data['dir']);
            ships_data['dir'] = (ships_data['dir'] + 3) % 4;
            drawShip(ships_data['x'], ships_data['y'],  model[ships_data['type']], 'blue', ships_data['dir']);
           /* $.get('test.php?move=left', function(data, status) {
                alert("data : " + data + "\nStatus" + status);
            })*/
        });

        $('#right_button').click(function(){
            eraseShip(ships_data['x'], ships_data['y'],  model[ships_data['type']],ships_data['dir']);
            ships_data['dir'] = (ships_data['dir'] + 1) % 4;
            drawShip(ships_data['x'], ships_data['y'],  model[ships_data['type']], 'blue', ships_data['dir']);
            /*$.get('test.php?move=right', function(data, status) {
                alert("data : " + data + "\nStatus" + status);
            })*/
        });

        $('#up_button').click(function(){
            eraseShip(ships_data['x'], ships_data['y'],  model[ships_data['type']],ships_data['dir']);
            switch (ships_data['dir']){
                case UP: ships_data['y']--;break;
                case DOWN: ships_data['y']++;break;
                case LEFT: ships_data['x']--;break;
                case RIGHT: ships_data['x']++;break;
            }
            drawShip(ships_data['x'], ships_data['y'], model[ships_data['type']], 'blue', ships_data['dir']);

            $.get('test.php?move=up', function(data, status) {
                alert("data : " + data + "\nStatus" + status);
            })
        });

        $('#submit_button').click(function(){
            $.get('test.php?move=down', function(data, status) {
                alert("data : " + data + "\nStatus" + status);
            })
        });

        $('#my-span').click(function(){
            console.log(ships_data);
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
	<li id='coordx'>cordoner x : 2</li>
	<li id='coordy'>cordoner y : 2</li>
	<li id='ptcoque'>pst coque : 10</li>
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
	<input id="submit_button" type="submit" value="SUBMIT" name="move">
	</div>
<div id="div_chat">
	<iframe name='chat' src='chat.php' width="100%" height="100%"></iframe>
	<div id="div_text"><input type='text' id='msg' value="" align="right"/><input type='submit' id="chat_ok" onclick="ecri()" value='OK' /></div>
</div>
</div>
</body>
</html>
