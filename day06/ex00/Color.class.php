#!/usr/bin/env php
<?php


class Color
{
	public	$red;
	public	$green;
	public	$blue;
	public static $verbose = FALSE;

	public function __construct($array)
	{
		if (isset($array['red']) && isset($array['green']) && isset($array['blue']))
		{
			$this->red		= intval($array['red']);
			$this->green	= intval($array['green']);
			$this->blue		= intval($array['blue']);
		}
		elseif(isset($array['rgb']))
		{
			$this->red		= (intval($array['rgb']) >> 16) & 0xFF;
			$this->green	= (intval($array['rgb']) >> 8) & 0xFF;
			$this->blue		= (intval($array['rgb']) & 0xFF);
		}
		if (self::$verbose)
		{
			echo("Successfully create object of type 'Color' with params:\nred: $this->red\tgreen: $this->green\tblue: $this->blue\n");
		}
	}

	public function add(Color $color)
	{
		$c = new Color(array(	'red'	=> $this->red + $color->red,
								'green'	=> $this->green + $color->green,
								'blue'	=> $this->blue + $color->blue));
		return $c;
	}

	public function sub(Color $color)
	{
		$c = new Color(array(	'red'	=> $this->red - $color->red,
								'green'	=> $this->green - $color->green,
								'blue'	=> $this->blue - $color->blue));
		return $c;
	}

	public function mult($m)
	{
		$c = new Color(array(	'red'	=> $this->red * $m,
								'green'	=> $this->green * $m,
								'blue'	=> $this->blue * $m));
		return $c;
	}

	public function __toString()
	{
		return "red: $this->red\tgreen: $this->green\tblue: $this->blue";
	}

	public static function doc()
	{
		echo "\n";
		$file = file_get_contents("Color.doc.txt");
		echo $file;
		echo "\n";
	}

}