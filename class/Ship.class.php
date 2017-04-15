<?php
require_once 'INorme42.class.php';
require_once 'TverifyKwargs.class.php';
require_once 'TClassesBase.class.php';

abstract class Ship implements INorme42 {
	use TverifyKwargs, TClassesBase;

	protected $_name;
	protected $_size;
	protected $_color;
	protected $_coord;
	protected $_sp; // shield point
	protected $_hp; // health point
	protected $_motorPower; // 
	protected $_speed;
	protected $_weapon;
	protected $_inertie;


	private function fill_model($path)
    {
        $file = file_get_contents($path);
        $file = explode(PHP_EOL, $file);
        return($file);
	}

	static public function doc() {return (PHP_EOL.file_get_contents('../docs/'.get_class().'.doc.txt'));}
	function getColor(){return $this->_color;}
	function getCoord(){return $this->_coord;}
	function __construct( array $kwargs ){
		if (array_key_exists( 'name', $kwargs))
			$this->_name = $kwargs['name'];
		else
			$this->_name = 'Default name';

		if ($this->kwargsHasSize($kwargs))
			$this->_size = $this->getSizeFromKwargs( $kwargs );
		else
			$this->_size = $this->getSizeFromArgs(0, 0);
		$this->_color == "black";

		if (array_key_exists( 'coord', $kwargs))
		{
			$this->_coord = array('x' => $kwargs['coord']['x'] , 'y' => $kwargs['coord']['y']);
			$kwargs['coord']['x'] ? $this->_coord['x'] = $kwargs['coord']['x'] : $this->_coord['x'] = 0;
			$kwargs['coord']['y'] ? $this->_coord['y'] = $kwargs['coord']['y'] : $this->_coord['y'] = 0;
		}
		else
			$this->_coord = array('x' => 0 , 'y' => 0);
		return;
	}

	public function move($dir){
		if ($dir == 'UP')
			$this->_coord['y'] -= 1;
		if ($dir == 'DOWN')
			$this->_coord['y'] += 1;
		if ($dir == 'LEFT')
			$this->_coord['x'] -= 1;
		if ($dir == 'RIGHT')
			$this->_coord['x'] += 1;
	}

/*	public function getCoord($coord){
		if (isset($coord) && ($coord == 'x' || $coord == 'y'))
		{
			return $this->_coord[$coord];
		}
		else
			return $this->coord;
}*/

	function __destruct (){return;}
}
?>
