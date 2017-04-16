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
    protected $_dir; // use this x y dir
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
/*		$this->_mysqli = new mysqli(DB_SERVER, DB_LOGIN, DB_PSW, DB_NAME);
		if ($this->_mysqli->connect_error){
			die("Connection Failed in Ship :" . $this->_mysqli->connect_error);
		}*/


		//ID
		array_key_exists( 'ship_id', $kwargs) ? $this->_id = $kwargs['ship_id'] :$this->_id  = -1;
        //USER_ID
        array_key_exists( 'ship_user_id', $kwargs ) ? $this->_uid = $kwargs['ship_user_id'] : $this->_uid = 0;
        //GAME_ID
        array_key_exists( 'ship_game_id', $kwargs ) ? $this->_gid = $kwargs['ship_game_id'] : $this->_gid = 0;
		//COORD
		if (array_key_exists('ship_pos_x', $kwargs) && array_key_exists('ship_pos_y', $kwargs)) {
            $this->_coord = array('x' => $kwargs['ship_pos_x'], 'y' => $kwargs['ship_pos_y']);
        }
        else {$this->_coord = array('x' => -1, 'y' => -1);}

        //DIR
        array_key_exists( 'ship_dir', $kwargs ) ? $this->_dir = $kwargs['ship_dir'] : $this->_dir = -1;
		//COLOR
        array_key_exists( 'ship_color', $kwargs ) ? $this->_color = $kwargs['ship_color'] : $this->_color = 'yellow';


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
		//COORD
	}

	public function updateDb($mysqli){
	    $req = "UPDATE ship set ship_pos_x = ". $this->_coord['x'] . ", ship_pos_y = " . $this->_coord['y'] .  " WHERE ship_id= " . $this->_id;
	    echo ($req);
        $mysqli->query($req);
	    /*if ($mysqli->query($req) === FALSE){
	        echo "Error updating coord ship : ". $mysqli();
		}*/
	}

	public function createShipInDb(){
/*	    $req = "INSERT INTO ship(ship_id, ship_user_id, ship_game_id, ship_pos_x, ship_pos_y, ship_color)";
        $req = $req ." VALUE($this->_id, $this->_uid, $this->ship_game, $this->_coord['x'], $this->_coord['y'], $this->_color)";
        if ($this->_mysqli->query($req) === FALSE){
            echo "Error INSERT ship : ". $this->_mysqli();
        }*/
	}
	function __destruct (){
	}
}
?>
