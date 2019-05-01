#!/usr/bin/env php
<?php
	if ($argc != 2)
		exit();
	$words = explode(" ", $argv[1]);
	$clear_words = array_values(array_filter($words));
	$num = count($clear_words);
	for ($i = 0; $i < $num - 1; $i++)
	{
		echo("$clear_words[$i] ");
	}
	$num--;
	echo("$clear_words[$num]\n");
?>