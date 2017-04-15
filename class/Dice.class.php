<?php

class Dice {
	private $_numberOfFace;

	static public function doc()
	{
		$content = PHP_EOL.file_get_contents('../docs/dice.doc.txt');
		return ($content);
	}
	function __get($att){print ("Attenpt to acces '_". $att . "' attribute". PHP_EOL );}
	function __set($att, $value){print ("Attempt to set '_" . $att . "' attribute to value '" .$value .PHP_EOL);}

	function __construct( array $kwargs )
	{
		if (array_key_exists( 'numberOfFace', $kwargs))
			$this->_numberOfFace = $kwargs['numberOfFace'];
		else
			$this->_numberOfFace = 6;
		return;
	}
	function __destruct (){return;}

	function __invoke(){
		return rand(1, $this->_numberOfFace);
	}
}
?>
