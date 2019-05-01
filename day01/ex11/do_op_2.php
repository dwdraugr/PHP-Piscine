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
	function solve($first, $second, $op)
	{
		if ($op == '+')
			$result = $first + $second;
		elseif ($op == '-')
			$result = $first - $second;
		elseif ($op == '*')
			$result = $first * $second;
		elseif ($op == '/')
			$result = $first / $second;
		else
			$result = $first % $second;
		return $result;
	}
	if ($argc != 2)
	{
		echo("Incorrect Parameters\n");
		exit();
	}
	$str = $argv[1];
	$len = strlen($str);
	for ($i = 0; $i < $len; $i++)
	{
		if (!is_numeric($str[$i]))
			if ($str[$i] != " ")
				if (!is_operator($str[$i]))
				{
					echo("Syntax Error\n");
					exit();
				}
	}
	if (strpos($str, "+") != FALSE)
	{
		$elems = explode("+", $str);
		$op = "+";
	}
	elseif (strpos($str, "-") != FALSE)
	{
		$elems = explode("-", $str);
		$op = "-";
	}
	elseif (strpos($str, "*") != FALSE)
	{
		$elems = explode("*", $str);
		$op = "*";
	}
	elseif (strpos($str, "/") != FALSE)
	{
		$elems = explode("/", $str);
		$op = "/";
	}
	elseif (strpos($str, "%") != FALSE)
	{
		$elems = explode("%", $str);
		$op = "%";
	}
	else
	{
		echo("Syntax Error\n");
		exit();
	}
	if (count($elems) != 2)
	{
		echo("Syntax Error\n");
		exit();
	}
	if (count(array_values(array_filter(explode(" ", $elems[0])))) != 1 ||
		count(array_values(array_filter(explode(" ", $elems[1])))) != 1)
	{
		echo("Syntax Error\n");
		exit();
	}
	$result = solve($elems[0], $elems[1], $op);
	echo("$result\n");
?>