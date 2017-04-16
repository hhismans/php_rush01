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
        $this->_type = 1;
        $this->_name = "Lich Barbarous";
        $this->_color = "red";
        $this->_hp = 5;
        $this->_sp = 5;
        $this->_motorPower = 3;
        $this->_speed = 1;
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
