#!/usr/bin/env php
<?php
	$fd = fopen("/var/run/utmpx", "rb");
	while (feof($fd))
	{
		$line = fgets($fd);
		print_r($line);
	}
?>