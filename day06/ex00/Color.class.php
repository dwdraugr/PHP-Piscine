<?php
class Color
{
	public	$red;
	public	$green;
	public	$blue;
	static  $verbose = FALSE;

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
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n",
					$this->red, $this->green, $this->blue);
		}
	}

	public function __destruct()
	{
		if (self::$verbose)
		{
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n",
				$this->red, $this->green, $this->blue);
		}
	}

	public function add(Color $color)
	{
		$red   = (($this->red   + $color->red) > 255) ? 255 : $this->red + $color->red;
		$green = (($this->green + $color->green) > 255) ? 255 : $this->green + $color->green;
		$blue  = (($this->blue  + $color->blue) > 255) ? 255 : $this->blue + $color->blue;
		$c = new Color(array(	'red'	=> $red,
								'green'	=> $green,
								'blue'	=> $blue));
		return $c;
	}

	public function sub(Color $color)
	{
		$red   = (($this->red   - $color->red) < 0) ? 0 : $this->red - $color->red;
		$green = (($this->green - $color->green) < 0) ? 0 : $this->green - $color->green;
		$blue  = (($this->blue  - $color->blue) < 0) ? 0 : $this->blue - $color->blue;
		$c = new Color(array(	'red'	=> $red,
			'green'	=> $green,
			'blue'	=> $blue));
		return $c;
	}

	public function mult($m)
	{
		$red   = (($this->red   * $m) > 255) ? 255 : $this->red * $m;
		$green = (($this->green * $m) > 255) ? 255 : $this->green * $m;
		$blue  = (($this->blue  * $m) > 255) ? 255 : $this->blue * $m;
		$c = new Color(array(	'red'	=> $red,
								'green'	=> $green,
								'blue'	=> $blue));
		return $c;
	}

	public function __toString()
	{
		return sprintf("Color( red: %3d, green: %3d, blue: %3d )",
			$this->red, $this->green, $this->blue);
	}

	public static function doc()
	{
		echo "\n";
		$file = file_get_contents("Color.doc.txt");
		echo $file;
		echo "\n";
	}
}