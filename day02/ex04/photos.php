#!/usr/bin/env php
<?php
	if ($argc != 2)
		exit();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $argv[1]);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
?>