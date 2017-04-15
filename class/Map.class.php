<?php
require_once 'INorme42.class.php';
require_once 'TverifyKwargs.class.php';
require_once 'TClassesBase.class.php';
require_once 'Tdump.class.php';
require_once 'Idumphtml.class.php';

Class Map implements INorme42, IDump{
	use TClassesBase, TDump, TverifyKwargs;
	private $_size;
	static public function doc() {return (PHP_EOL.file_get_contents('../docs/Map.doc.txt'));}
	function __construct( array $kwargs ){
		if ($this->kwargsHasSize($kwargs))
			$this->_size = $this->getSizeFromKwargs( $kwargs );
		else
			$this->_size = $this->getSizeFromArgs(150, 100);
	}
	function getHtml(){
		$var = "<table>".PHP_EOL;
		for ($i = 0; $i < $this->_size['height']; $i++)
		{
			$var = $var."\t<tr>".PHP_EOL;
			for ($j = 0; $j < $this->_size['width']; $j++)
			{
				$var = $var."\t\t<th></th>".PHP_EOL;
			}
			$var = $var."\t</tr>".PHP_EOL;
		}
		$var = $var."</table>".PHP_EOL;
		return ($var);
	}
	function __destruct(){return;}
}
?>
