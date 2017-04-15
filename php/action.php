<?php
session_start();
include('connexion.php');

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
}
exit();
?>
