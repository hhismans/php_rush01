<?PHP
session_start();
include('connexion.php');
if ($_SESSION["id"] == "")
{
    header("location: ../index.php");
    return;
}

if(isset($_POST["create"]))
{
    if ($_SESSION["game_id"] == "")
    {
        $mysqli->query("INSERT INTO `game` (`game_user_id1`) VALUES ('".$_SESSION["id"]."')");
        $_SESSION["game_id"] = $mysqli->insert_id;
    }
}
else if($_POST["join"] != "")
{
    if ($_SESSION["game_id"] == "")
    {
        $mysqli->query("UPDATE `game` SET `game_user_id2` = '".$_SESSION['id']."', `game_lock` = '1' WHERE `game_id` = '".$_POST['join']."'");
        $stmt = $mysqli->prepare("SELECT `game_id` FROM `game` ORDER BY `game_id` DESC LIMIT 1");
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        $_SESSION["game_id"] = $id;

    }
}
if($_SESSION["game_id"] == "")
{
    header("location: lobby.php");
    return;
}
require_once('../class/App.class.php');
$_SESSION['app'] = new App(array());
$_SESSION['app']->dumpHtml();
?>
<html>
<meta charset="UTF-8">
<title>game</title>
<link rel='stylesheet' type='text/css' href='../css/style.css'></link>
<script src='../js/jquery-3.2.1.min.js'></script>
<body>
<script>
    function mapPutPixel(x, y, color) {
        str = "#line"+ y + " th:nth-child(" + x + ")";
//	console.log(str);
        $(str).css('background', color);
    }

    function moveShip(){

    }

    const DOWN = 0;
    const LEFT = 1;
    const UP = 2;
    const RIGHT = 3;
    $(document).ready(function() {
        currentShip = null;
        current = 0;

        //LEFT BUTTON
        $('#left_button').click(function(){
            eraseShip(currentShip['ship_pos_x'],currentShip['ship_pos_y'], model[currentShip['ship_type']] , currentShip['ship_dir']);
            currentShip['ship_dir'] = (currentShip['ship_dir'] + 3) % 4;
            drawShip(currentShip['ship_pos_x'], currentShip['ship_pos_y'], model[currentShip['ship_type']], currentShip['ship_color'], currentShip['ship_dir']);
            $.ajax({
                url:"action.php",
                type:"post",
                data:parseArrayToPost(currentShip, "ship"),
                success:function(msg){
                    console.log ("HERE IS RESULT ",msg);
                }
            });
        });

        //RUGHT BUTTON
        $('#right_button').click(function(){
            eraseShip(currentShip['ship_pos_x'],currentShip['ship_pos_y'], model[currentShip['ship_type']] , currentShip['ship_dir']);
            currentShip['ship_dir'] = (currentShip['ship_dir'] + 1) % 4;
            console.log("current ship dir", currentShip['ship_dir']);
            drawShip(currentShip['ship_pos_x'], currentShip['ship_pos_y'], model[currentShip['ship_type']], currentShip['ship_color'], currentShip['ship_dir']);
        });

        function parseArrayToPost(array, type){
            ret = type + "=true";
            for (var key in array) {
                if (array.hasOwnProperty(key)) {
                    ret += "&" + key + "=" + array[key];
                }
            }
            return (ret);
        }
        //UP BUTTON
        //data:"ship=true" + "&x=" + current['x'] + "&y=" + ships_data['y'] + "&ship_id= " + ships_data['ship_id'],
        $('#up_button').click(function(){
            eraseShip(currentShip['ship_pos_x'],currentShip['ship_pos_y'], model[currentShip['ship_type']] , currentShip['ship_dir']);
            parseArrayToPost(currentShip);
            console.log ('ship _dir = ', currentShip['ship_dir']);
            switch (parseInt(currentShip['ship_dir'])){
                case UP: currentShip['ship_pos_y']--;break;
                case DOWN: currentShip['ship_pos_y']++;break;
                case LEFT: currentShip['ship_pos_x']--;break;
                case RIGHT: currentShip['ship_pos_x']++;break;
            }
            //drawShip(ships_data['ship_pos_x'], ships_data['ship_pos_y'], model[ships_data['ship_type']], 'blue',DOWN);// ships_data['dir']);
            $.ajax({
                url:"action.php",
                type:"post",
                data:parseArrayToPost(currentShip, "ship"),
                success:function(msg){
                    console.log ("HERE IS RESULT ",msg);
                }
            });
            drawShip(currentShip['ship_pos_x'], currentShip['ship_pos_y'], model[currentShip['ship_type']], currentShip['ship_color'], currentShip['ship_dir']);
        });

        //SUBMIT
        $('#submit_button').click(function(){
            current+=1;
            if (current < ships_data.length)
                currentShip = ships_data[current];
            else
            {
                current=0;
                currentShip = ships_data[0];
                console.log('end of ship');
            }
        });




        function eraseShip(x, y, model, dir) {
            x = parseInt(x) + 1;
            y = parseInt(y);
            if (dir == DOWN) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x - Math.floor((model[0].length / 2)) + j, y - Math.floor((model.length / 2)) + i, 'lightblue');
                    }
                }
            }
            if (dir == UP) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x + Math.floor((model[0].length / 2)) - j, y + Math.floor((model.length / 2)) - i, 'lightblue');
                    }
                }
            }
            if (dir == LEFT) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x + Math.floor((model.length / 2)) - i, y + Math.floor((model[0].length / 2)) - j, 'lightblue');
                    }
                }
            }
            if (dir == RIGHT) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x - Math.floor((model.length / 2)) + i, y - Math.floor((model[0].length / 2)) + j, 'lightblue');
                    }
                }
            }
        }
        function drawShip(x, y, model, color, dir) {
            (x)= parseInt(x) + 1;
            (y)= parseInt(y);
            console.log ("in draw ", x, y);
            if (dir == DOWN) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                        {
                            mapPutPixel(x - Math.floor((model[0].length / 2)) + j, y - Math.floor((model.length / 2)) + i, color);
                        }
                    }
                }
            }
            else if (dir == UP) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x + Math.floor((model[0].length / 2)) - j, y + Math.floor((model.length / 2)) - i, color);
                    }
                }
            }
            else if (dir == LEFT) {
                for (i = 0; i < model.length; i++) {
                    for (j = 0; j < model[i].length; j++) {
                        if (model[i][j] == '#')
                            mapPutPixel(x + Math.floor((model.length / 2)) - i, y + Math.floor((model[0].length / 2)) - j, color);
                    }
                }
            }
            else if (dir == RIGHT) {
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
        function ajaxGetShip(handleData) {
            $.ajax({
                url: "action.php?action=getship",
                type: "get",
                success: function (msg) {
                    ships_data = JSON.parse(msg);
                    for (a = 0; a < ships_data.length; a++) {
                        drawShip(ships_data[a]['ship_pos_x'], ships_data[a]['ship_pos_y'], model[ships_data[a]['ship_type']], ships_data[a]['ship_color'], ships_data[a]['ship_dir']);
                    }
                    handleData(ships_data);
                    //setInterval(function() {ajaxGetShip();}, );
                }
            });
        }

        	ajaxGetShip(function (ships_data){
            currentShip = ships_data[current];
        	});


	    function ecri()
	    {
	        $.post("req_php.php?page=game", { text: $("#msg").val()});
	        $("#msg").val("");
	    }

	    $(document).keypress(function (e) {
	        if (e.which == 13 || event.keyCode == 13) {
	            ecri();
	        }});

    });
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
