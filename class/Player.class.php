<?php
Class Player implements INorme42 {
    use TGenerateShips, TClassesBase;

	private static	$_idCount = 0;
	private			$_id;
	private			$_name;
	private			$_ships;

	static public function doc() {return (PHP_EOL.file_get_contents('../docs/Player.doc.txt'));}

	function __construct( array $kwargs )
    {
        $this->_idCount += 1;
        $this->_id = $this->_idcount;

        array_key_exists('name', $kwargs) ? $this->_name = $kwargs['name'] : $this->_name = "Player";

        if (array_key_exists('ships', $kwargs))
            $this->_ships = $kwargs['ships'];
        else
           $this->_ships = $this->createShips(array('player' => 1));

		return;
	}
	function __destruct(){
		$this->_idCount -= 1;
	    return;
	}
}
?>
