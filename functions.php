<?php

function debug($arr)
{

	$bt = debug_backtrace();
	$caller = array_shift($bt);

	echo  '<pre class="debug" style =" color: green;">' . $caller['file'] . " (on line: " . $caller['line'] . ")" . '</pre>' ;

	echo '<pre class="debug" style =" color: #cc0000;">' . print_r($arr, true) . '</pre>';
}
