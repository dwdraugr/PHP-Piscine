#!/usr/bin/env php
<?php
	function ft_split($str)
	{
		$words = explode(" ", $str);
		$sort_words = array_values(array_filter($words));
		sort($sort_words);
		return $sort_words;
	}

	print_r(ft_split("Hello   World AAA"));
?>