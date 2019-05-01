<?php
	function ft_split($str)
	{
		$words = explode(" ", $str);
		$sort_words = array_values(array_filter($words));
		sort($sort_words);
		return $sort_words;
	}
	if ($argc > 1)
	{
		$arr = array();
		for ($i = 1; $i < count($argv); $i++)
		{
			$str = trim(preg_replace("/\s+/", " ", $argv[$i]));
			$dell_space = ft_split($str);
			for ($j = 0; $j < count($dell_space); $j++) {
				$word = array_push($arr, $dell_space[$j]);
			}
		}
		sort($arr);
		for ($i = 0; $i < count($arr); $i++)
			echo ($arr[$i]."\n");
	}
?>