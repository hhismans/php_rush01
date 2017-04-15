<?php
require_once 'Ship.class.php';
Class miniship extends Ship {
	static public function doc() {return (PHP_EOL.file_get_contents('../docs/miniship.doc.txt'));}
		function __construct( array $kwargs ){
			parent::__construct( $kwargs );
			$this->_size = $this->getSizeFromArgs(1,1);
			return;
		}
	function __destruct(){return;}
}
?>
