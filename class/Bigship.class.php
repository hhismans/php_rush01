<?php
require_once 'Ship.class.php';
//finalize
Class Miniship extends Ship
{
    static public function doc()
    {
        return (PHP_EOL . file_get_contents('../docs/miniship.doc.txt'));
    }

    function __construct(array $kwargs)
    {
        parent::__construct($kwargs);
        $this->_size = $this->getSizeFromArgs(3, 3);
        $this->_type = 0;
        $this->_name = "Cold Escar";
        $this->_color = "lightgreen";
        $this->_hp = 4;
        $this->_sp = 3;
        $this->_motorPower = 6;
        $this->_speed = 5;
        return;
    }

    function move()
    {
        parent::move();
        /*$req = "UPDATE ship set ship_type = $this->_type WHERE ship_id=$this->_id";
        if ($this->_mysqli->query($req) === FALSE) {
            echo "Error updating coord ship : " . $this->_mysqli();
        }*/
    }

    function __destruct()
    {
        parent::__destruct();
        return;
    }
}
?>
