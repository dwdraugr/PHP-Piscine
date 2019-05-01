#!/usr/bin/env php
<?php
	function ft_is_sort($arg)
	{
		$tmp = $arg;
		sort($tmp);
		for($i = 0; $i < count($arg); $i++)
		{
			if (strcmp($arg[$i], $tmp[$i]))
				return FALSE;
		}
		return TRUE;
	}
?>