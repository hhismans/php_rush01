<?php
require_once('INorme42.class.php');
require_once('Map.class.php');
require_once('Footer.class.php');
require_once('miniship.class.php');
Class App implements INorme42, Idump{//implements INorme42, IdumpHtml{
	use TClassesBase, TDump;

	private $_map;
	private $_footer;
    private $_ship;
	private $_Players; // tab with players name

	static public function doc() {return (PHP_EOL.file_get_contents('../docs/App.doc.txt'));}
	function __construct( array $kwargs ){
		$this->_map = new Map(array());
		$this->_footer = new Footer(array());

		if (array_key_exists( 'dataObj', $kwargs ))
		{
			$this->_ship = new miniship(array('coord' => array ('x' => $kwargs['dataObj']->x, 'y' => $kwargs['dataObj']->y )));
		}
		else
		{
			$this->_ship = new miniship(array());
		}
		return;
	}
	function __destruct(){return;}

	public function getHtml() {
		$var = $this->_map->getMapHtml(array('ship' => $this->_ship)).PHP_EOL;
//		$var = $var.$this->_footer->getHtml(PHASE_1);
		return $var;
	}
	public function getShip()
	{
		return $this->_ship;
	}
}
?>


