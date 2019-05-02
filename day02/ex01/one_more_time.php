#!/usr/bin/env php
<?php
	$month = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août",
				"septembre", "octobre", "novembre", "décembre");
	$week = array("lundi", "mardi", "mecredi", "jeudi", "vendredi", "samedi", "dimanche");
	date_default_timezone_set("Europe/Paris");
	if ($argv == 1)
		exit();
	$in_str = $argv[1];
	$pattern = "/^[a-zA-Zéû]+\s\d{1,2}\s[a-zA-Zéû]+\s\d{4}\s[0-2][0-9]:[0-5][0-9]:[0-5][0-9]$/";
	$is_cmp = preg_match($pattern, "$in_str");
	if ($is_cmp == 0)
	{
		echo("Wrong Format\n");
		exit();
	}
	$date = explode(" ", $in_str);
	$date[4] = explode(":", $date[4]);
	$date[0] = strtolower($date[0]);
	$date[2] = strtolower($date[2]);
	$key1 = array_search($date[0], $week) + 1;
	$key2 = array_search($date[2], $month) + 1;
	if ($key1 === FALSE || $key2 === FALSE)
	{
		echo("Wrong Format\n");
		exit();
	}
	$date[0] = $key1;
	$date[2] = $key2;
	$time = mktime($date[4][0], $date[4][1], $date[4][2], $date[2], $date[1], $date[3]);
	if ($time === FALSE)
	{
		echo("Wrong Format\n");
		exit();
	}
	$day_of_week = date("N", $time);
	$correct_date = checkdate($date[2], $date[1], $date[3]);
	if ($day_of_week != $date[0] || $correct_date == FALSE)
	{
		echo("Wrong Format\n");
		exit();
	}
	echo("$time\n");
?>