<?php
session_start();
include('connexion.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == "getship") {
        $stmt = $mysqli->prepare("SELECT ship_pos_x, ship_pos_y, ship_type  FROM `ship` WHERE ship_id=1");
        $stmt->execute();
        $stmt->bind_result($coordX, $coordY, $type);
        $stmt->fetch();
        echo json_encode(array ('x' => $coordX, 'y' => $coordY, 'type' => $type));
        exit();
    }
}
exit();
?>
