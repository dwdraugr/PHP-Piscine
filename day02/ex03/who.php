#!/usr/bin/php
<?php
	date_default_timezone_set('Europe/Moscow');
	$file = fopen("/var/run/utmpx", "r");
	while ($bin = fread($file, 628))
	{
		$bin = unpack("a256user/a4id/a32line/ipid/itype/i2time/a256host/i16pad", $bin);
		if ($bin["type"] == 7)
			$user[$bin["line"]] = array("user" => $bin["user"], "time" => $bin["time1"]);
	}

	foreach($user as $line => $data)
	{
		echo substr($str, 0, 7)."\t".substr($line, 0, 7)."\t".date("M  j H:i", $data["time"])." \n";
	}
?>