<?php
require_once 'INorme42.class.php';
require_once 'TverifyKwargs.class.php';
require_once 'TClassesBase.class.php';
require_once 'Tdump.class.php';
require_once 'Idumphtml.class.php';
Class Footer implements INorme42, IDump{
	use TDump, TClassesBase;
	static public function doc() {return (PHP_EOL.file_get_contents('../docs/Footer.doc.txt'));}
	function __construct(array $kwargs){return;}
	function __destruct(){return;}

	function getHtml()
	{
		$var = "<div class=\"flex-container\">".PHP_EOL;

		$var = $var."\t<div>".PHP_EOL;
		$var = $var."\t\t<p>Player 1</p>".PHP_EOL;
		$var = $var."\t\t<p>Ship : </p>".PHP_EOL;
		$var = $var."\t\t<p>heatlh : </p>".PHP_EOL;
		$var = $var."\t\t<p>pp : </p>".PHP_EOL;
		$var = $var."\t</div>".PHP_EOL;

		$var = $var."<form class=\"flex-container flex-column\" action=\"move.php\" method=\"post\">".PHP_EOL;

		$var = $var."\t<input hidden name=\"xCoord\" value=\"<?php \$app->getShip()->getCoord()['x'] ?>\">".PHP_EOL;
		$var = $var."\t<input hidden name=\"yCoord\" value=\"<?php \$app->getShip()->getCoord()['y'] ?>\">".PHP_EOL;

		$var = $var."\t<input class=\"up\" type=\"submit\" value=\"UP\" name=\"move\">".PHP_EOL;
		$var = $var."\t<div class=\"flex-body flex-row\">".PHP_EOL;
		$var = $var."\t\t<input class=\"left\" type=\"submit\" value=\"LEFT\" name=\"move\">".PHP_EOL;
		$var = $var."\t\t<input class=\"right\" type=\"submit\" value=\"RIGHT\" name=\"move\">".PHP_EOL;
		$var = $var."\t</div>".PHP_EOL;
		$var = $var."\t<input type=\"submit\" value=\"DOWN\" name=\"move\">".PHP_EOL;
		$var = $var."</form>".PHP_EOL;

		$var = $var."</div>".PHP_EOL;
		return $var;
	}
}
?>
