<?PHP
session_start();
require_once('../class/App.class.php');
include('connexion.php');

if ($_SESSION["id"] != "")
{
    echo "<html>
	    <linK rel='stylesheet' type='text/css' href='../css/style.css'>
	    <script src='../js/jquery-3.2.1.min.js'></script>
		<body style=\"margin-bottom:0px\">
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

        model = new Array();
        model.push("###########");
        model.push("###########");
        model.push("###########");
        model.push("   #####   ");
        model.push("   #####   ");
        model.push("   #####   ");
        model.push("   #####   ");
        model.push("   #####   ");
        model.push("   #####   ");
        model.push("   #####   ");
        model.push("  #######  ");
        model.push("  #######  ");
        model.push("  #######  ");
        model.push("  #######  ");
        model.push("  #######  ");
        model.push("  #######  ");

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
                ship_coord['dir'] = DOWN;
                console.log("rpout", ship_coord, ship_coord['x']);
                drawShip(ship_coord['x'],ship_coord['y'],model, 'blue', ship_coord['dir']);
            }
        });

        $('#left_button').click(function(){
            console.log('left click');
            eraseShip(ship_coord['x'], ship_coord['y'], model,ship_coord['dir']);
            ship_coord['dir'] = (ship_coord['dir'] + 3) % 4;
            drawShip(ship_coord['x'], ship_coord['y'], model, 'blue', ship_coord['dir']);
           /* $.get('test.php?move=left', function(data, status) {
                alert("data : " + data + "\nStatus" + status);
            })*/
        });

        $('#right_button').click(function(){
            eraseShip(ship_coord['x'], ship_coord['y'], model,ship_coord['dir']);
            ship_coord['dir'] = (ship_coord['dir'] + 1) % 4;
            drawShip(ship_coord['x'], ship_coord['y'], model, 'blue', ship_coord['dir']);
            /*$.get('test.php?move=right', function(data, status) {
                alert("data : " + data + "\nStatus" + status);
            })*/
        });

        $('#up_button').click(function(){
            eraseShip(ship_coord['x'], ship_coord['y'], model,ship_coord['dir']);
            switch (ship_coord['dir']){
                case UP: ship_coord['y']--;break;
                case DOWN: ship_coord['y']++;break;
                case LEFT: ship_coord['x']--;break;
                case RIGHT: ship_coord['x']++;break;
            }
            drawShip(ship_coord['x'], ship_coord['y'], model, 'blue', ship_coord['dir']);

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
