<?php
/**
 * Created by PhpStorm.
 * User: hhismans
 * Date: 4/14/17
 * Time: 1:37 PM
 */

trait TGenerateShips {
    function createShips(array $kwargs)
    {
        $ret = array();
        if (array_key_exists('player', $kwargs)) {
            if ($kwargs['player'] == 1)
            {
                $coord = array('x' => 0, 'y' => 0);
                $ret[] = new miniship(array ('coord' => $coord));
                $coord = array('x' => 1, 'y' => 0);
                $ret[] = new miniship(array ('coord' => $coord));
                $coord = array('x' => 2, 'y' => 0);
                $ret[] = new miniship(array ('coord' => $coord));
            }
            else if ($kwargs['player'] == 2)
            {
                $coord = array('x' => 0, 'y' => 0);
                $ret[] = new miniship(array ('coord' => $coord));
                $coord = array('x' => 1, 'y' => 0);
                $ret[] = new miniship(array ('coord' => $coord));
                $coord = array('x' => 2, 'y' => 0);
                $ret[] = new miniship(array ('coord' => $coord));
            }
        }
        return ($ret);
    }
}
?>