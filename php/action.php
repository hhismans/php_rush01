<?php
session_start();
include('connexion.php');
require_once ('../class/miniship.class.php');
if (isset($_GET['action'])) {
    if ($_GET['action'] == "getship") {

        $query = $mysqli->query("SELECT *  FROM `ship` WHERE ship_game_id=1");
        //$stmt = $mysqli->prepare("SELECT ship_pos_x, ship_pos_y, ship_type  FROM `ship` WHERE ship_game_id=1");
        //$stmt->execute();

        $ret = Array();
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $ret[] = $row;
        }
        //$stmt->bind_result($coordX, $coordY, $type);
        //$stmt->fetch_array();
        echo json_encode($ret);
        exit();
    }

    if ($_GET['action'] == "refreshship") {

        $query = $mysqli->query("SELECT `ship_id`, `ship_user_id`, `ship_game_id`, `ship_pos_x`, `ship_pos_y`, `ship_pts_coque`, `ship_shield`, `ship_color`, `ship_dir`, `ship_type`, `ship_wpn`, `ship_refresh_j".$_SESSION['nb_joueur']."` as nb_jr  FROM `ship` WHERE ship_game_id='1'");
        $ret = Array();
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $ret[] = $row;
        }
        //$mysqli->query("UPDATE `ship` SET `ship_refresh_j".$_SESSION['nb_joueur']."` = '1' WHERE ship_game_id='1' AND `ship_refresh_j".$_SESSION['nb_joueur']."` = 0");
        echo json_encode($ret);
        exit();
    }
}
else if (isset($_POST))
{
   if (isset($_POST['ship']))
   {
      $ship = new Ship($_POST);
      $ship->updateDb($mysqli);
   }
}
exit();
?>
