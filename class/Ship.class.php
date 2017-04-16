<?php
require_once 'INorme42.class.php';
require_once 'TverifyKwargs.class.php';
require_once 'TClassesBase.class.php';

define("DB_SERVER", "localhost");
define("DB_LOGIN", "root");
define("DB_PSW", "root");
define("DB_NAME", "db_rush01");

class Ship implements INorme42 {
	use TverifyKwargs, TClassesBase;

    protected $_id; // use this
    protected $_uid; // use this
    protected $_gid; // use this
	protected $_name; // use this
	protected $_size; // use this
	protected $_color; // use this
	protected $_coord; // use this x y dir
	protected $_sp; //  useless
	protected $_hp; // maybe use
	protected $_motorPower;  //useless
	protected $_speed; // useless
	protected $_weapon; // maybe use
	protected $_inertie; // useless

    protected $_mysqli;

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

        //SQLICONNECT
		$this->_mysqli = new mysqli(DB_SERVER, DB_LOGIN, DB_PSW, DB_NAME);
		if ($this->_mysqli->connect_error){
			die("Connection Failed in Ship :" . $this->_mysqli->connect_error);
		}

		//NAME
		if (array_key_exists( 'name', $kwargs))
			$this->_name = $kwargs['name'];
		else
			$this->_name = 'Default name';

		//SIZE
		if ($this->kwargsHasSize($kwargs))
			$this->_size = $this->getSizeFromKwargs( $kwargs );
		else
			$this->_size = $this->getSizeFromArgs(0, 0);

		//COLOR
        if (array_key_exists( 'color', $kwargs))
			$this->_color == $kwargs['color'];
        else
        	$this->color = "black"; //css property

		//USER_ID
		array_key_exists( 'user_id', $kwargs ) ? $this->_uid = $kwargs['user_id'] : $this->_uid = 0;
		//GAME_ID
        array_key_exists( 'game_id', $kwargs ) ? $this->_gid = $kwargs['game_id'] : $this->_gid = 0;

		//COORD
		if (array_key_exists( 'coord', $kwargs)) {
            $this->_coord = array('x' => $kwargs['coord']['x'], 'y' => $kwargs['coord']['y']);
            $kwargs['coord']['x'] ? $this->_coord['x'] = $kwargs['coord']['x'] : $this->_coord['x'] = 0;
            $kwargs['coord']['y'] ? $this->_coord['y'] = $kwargs['coord']['y'] : $this->_coord['y'] = 0;
            $kwargs['coord']['dir'] ? $this->_coord['dir'] = $kwargs['coord']['dir'] : $this->_coord['y'] = 0;
            $this->move();
        }
		else
			$this->_coord = array('x' => 0 , 'y' => 0);
	}

	public function move(){
	    $req = "UPDATE ship set ship_pos_x = $this->_coord['x'], ship_pos_y = $this->_coord['y'] WHERE ship_id=$this->_id";
	    if ($this->_mysqli->query($req) === FALSE){
	        echo "Error updating coord ship : ". $this->_mysqli();
		}
	}

	public function createShipInDb(){
	    $req = "INSERT INTO ship(ship_id, ship_user_id, ship_game_id, ship_pos_x, ship_pos_y, ship_color)";
        $req = $req ." VALUE($this->_id, $this->_uid, $this->ship_game, $this->_coord['x'], $this->_coord['y'], $this->_color)";
        if ($this->_mysqli->query($req) === FALSE){
            echo "Error INSERT ship : ". $this->_mysqli();
        }
	}
	function __destruct (){
		$this->_mysqli->close();
	}
}
?>
