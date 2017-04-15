<?php

interface INorme42 {
	static public function doc();
	function __get($att);
	function __set($att, $value);
	function __construct(array $kwargs);
	function __destruct();
}
?>

