#!/usr/bin/env php
<?php
	if ($argc < 2)
		exit();
	$words = explode(" ", $argv[1]);
	$clear_words = array_values(array_filter($words));
	$tmp = array_shift($clear_words);
	$clear_words[] = $tmp;
	for ($i = 0; $i < count($clear_words); $i++)
	{
		echo("$clear_words[$i]");
		if ($i != count($clear_words) - 1)
			echo(" ");
	}
	echo("\n");
?>