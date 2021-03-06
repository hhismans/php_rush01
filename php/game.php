<?PHP
session_start();
include('connexion.php');
if ($_SESSION["id"] == "")
{
    header("location: ../index.php");
    return;
}

function create_ship1($mysqli)
{
	$mysqli->query("INSERT INTO `ship` (`ship_user_id`, `ship_game_id`, `ship_pos_x`, `ship_pos_y`, `ship_pts_coque`, `ship_shield`, `ship_color`, `ship_dir`, `ship_type`, `ship_wpn`) VALUES ('".$_SESSION["id"]."', '".$_SESSION["game_id"]."', '10', '10', '3', '2', 'black', '0', '2', '1')");
	$mysqli->query("INSERT INTO `ship` (`ship_user_id`, `ship_game_id`, `ship_pos_x`, `ship_pos_y`, `ship_pts_coque`, `ship_shield`, `ship_color`, `ship_dir`, `ship_type`, `ship_wpn`) VALUES ('".$_SESSION["id"]."', '".$_SESSION["game_id"]."', '50', '10', '5', '5', 'red', '0', '1', '1')");
	$mysqli->query("INSERT INTO `ship` (`ship_user_id`, `ship_game_id`, `ship_pos_x`, `ship_pos_y`, `ship_pts_coque`, `ship_shield`, `ship_color`, `ship_dir`, `ship_type`, `ship_wpn`) VALUES ('".$_SESSION["id"]."', '".$_SESSION["game_id"]."', '100', '10', '4', '3', 'green', '0', '0', '1')");
}

function create_ship2($mysqli)
{
	$mysqli->query("INSERT INTO `ship` (`ship_user_id`, `ship_game_id`, `ship_pos_x`, `ship_pos_y`, `ship_pts_coque`, `ship_shield`, `ship_color`, `ship_dir`, `ship_type`, `ship_wpn`) VALUES ('".$_SESSION["id"]."', '".$_SESSION["game_id"]."', '10', '80', '3', '2', 'pink', '2', '2', '1')");
	$mysqli->query("INSERT INTO `ship` (`ship_user_id`, `ship_game_id`, `ship_pos_x`, `ship_pos_y`, `ship_pts_coque`, `ship_shield`, `ship_color`, `ship_dir`, `ship_type`, `ship_wpn`) VALUES ('".$_SESSION["id"]."', '".$_SESSION["game_id"]."', '50', '80', '5', '5', 'blue', '2', '1', '1')");
	$mysqli->query("INSERT INTO `ship` (`ship_user_id`, `ship_game_id`, `ship_pos_x`, `ship_pos_y`, `ship_pts_coque`, `ship_shield`, `ship_color`, `ship_dir`, `ship_type`, `ship_wpn`) VALUES ('".$_SESSION["id"]."', '".$_SESSION["game_id"]."', '100', '80', '4', '3', 'orange', '2', '0', '1')");

	echo "INSERT INTO `ship` (`ship_user_id`, `ship_game_id`, `ship_pos_x`, `ship_pos_y`, `ship_pts_coque`, `ship_shield`, `ship_color`, `ship_dir`, `ship_type`, `ship_wpn`) VALUES ('".$_SESSION["id"]."', '".$_SESSION["game_id"]."', '100', '80', '4', '3', 'orange', '2', '0', '1')";
}

if(isset($_POST["create"]))
{
    if ($_SESSION["game_id"] == "")
    {
    	$_SESSION['nb_joueur'] = 1;
        $mysqli->query("INSERT INTO `game` (`game_user_id1`) VALUES ('".$_SESSION["id"]."')");
        $_SESSION["game_id"] = $mysqli->insert_id;
        create_ship1($mysqli);
    }
}
else if($_POST["join"] != "")
{
    if ($_SESSION["game_id"] == "")
    {
    	$_SESSION['nb_joueur'] = 2;
        $mysqli->query("UPDATE `game` SET `game_user_id2` = '".$_SESSION['id']."', `game_lock` = '1' WHERE `game_id` = '".$_POST['join']."'");
        $_SESSION["game_id"] = $_POST['join'];
        create_ship2($mysqli);
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
<script src="../js/main_control.js"></script>


<body>
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
