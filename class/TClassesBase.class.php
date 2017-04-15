<?php
trait TClassesBase {
	function __get($att){print('Attempt to acces \''. $att . '\' attribute' .PHP_EOL);}
	function __set($att, $value){print('Attempt to acces \''. $att . '\' attribute' .PHP_EOL);}
}
?>
