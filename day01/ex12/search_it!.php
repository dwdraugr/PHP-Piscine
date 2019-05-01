#!/usr/bin/env php
<?php
	if ($argc <= 2)
		exit();
	$search_key = $argv[1];
	$elems = array_slice($argv, 2);
	$mass = array();
	foreach ($elems as $elem)
	{
		$mass[] = explode(":", $elem);
	}
	$mass = array_reverse($mass);
	foreach ($mass as $elem)
	{
		if ($elem[0] == $search_key)
		{
			echo("$elem[1]\n");
			exit();
		}
	}
?>