#!/usr/bin/env php
<?php
	$table = array();
	while (!feof(STDIN))
	{
		$str = fgets(STDIN);
		$table[] = explode(";", $str);
	}
	array_pop($table);
	if ($argv[1] == "average")
	{
		$sum = 0;
		$num = count($table);
		foreach ($table as $elem)
		{
			if (is_numeric($elem[1]))
				$sum += intval($elem[1]) + intval($elem[3]);
		}
		$result = $sum / $num;
	}
	echo("$result\n");
	?>
