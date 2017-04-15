<?php

require_once('miniship.class.php');

trait TDump {
	function dumpHtml()
	{
		echo $this->getHtml();
	}
	function thereIsAShip(Ship $ship)
	{

	}

	function getMapHtml(array $kwargs){
		$var = "<table>".PHP_EOL;
		for ($i = 0; $i < $this->_size['height']; $i++)
		{
			$var = $var."\t<tr id=\"line".$i."\">".PHP_EOL;
			for ($j = 0; $j < $this->_size['width']; $j++)
			{
				if ($kwargs['ship']->getCoord()['x'] == $j && $kwargs['ship']->getCoord()['y'] == $i)
					$var = $var."\t\t<th class=\"ship\"></th>".PHP_EOL;
				else
					$var = $var."\t\t<th></th>".PHP_EOL;
			}
			$var = $var."\t</tr>".PHP_EOL;
		}
		$var = $var."</table>".PHP_EOL;
		return ($var);
	}
}
?>
