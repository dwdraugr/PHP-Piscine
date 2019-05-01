#!/usr/bin/env php
<?php
	function is_operator($c)
	{
		$tmp = trim($c);
		if ($tmp == '+' || $tmp == '-' || $tmp == '*' || $tmp == '/' || $tmp == '%')
			return TRUE;
		else
			return FALSE;
	}
	if ($argc != 4 || !is_numeric($argv[1]) || !is_numeric($argv[3]) || !is_operator($argv[2]))
	{
		echo("Incorrect Parameters\n");
		exit();
	}
	for ($i = 1; $i < $argc; $i++)
		$argv[$i] = trim($argv[$i]);
	$first = intval($argv[1]);
	$second = intval($argv[3]);
	$op = $argv[2];
	if ($op == '+')
		$result = $first + $second;
	elseif ($op == '-')
		$result = $first - $second;
	elseif ($op == '*')
		$result = $first * $second;
	elseif ($op == '/')
		$result = $first / $second;
	elseif ($op == '%')
		$result = $first % $second;
	echo("$result\n")
?>