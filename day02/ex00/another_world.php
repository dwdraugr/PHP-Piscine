#!/usr/bin/env php
<?php
	if ($argc == 1)
		exit();
	$str = $argv[1];
	$str = trim(preg_replace("/\s+/", " ", $str));
	echo($str."\n");
?>