<?php


class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 1.0;
	private $color;
	static  $verbose = FALSE;

	function __construct($array)
	{
		$this->_x = $array['x'];
		$this->_y = $array['y'];
		$this->_z = $array['z'];
		if (isset($array['w']) && !empty($array['w']))
			$this->_w = $array['w'];
		if (isset($array['color']) && !empty($array['color']))
			$this->color = $array['color'];
		else
			$this->color = new Color(array('r' => 255, 'g' => 255, 'b' => 255));
		if (Vertex::$verbose)
		{
			if (Color::$verbose)
			{

			}
		}
	}
}