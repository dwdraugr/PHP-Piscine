<?php

class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 1.0;
	private $color;
	static  $verbose = FALSE;

	public function __construct(array $array)
	{
		$this->_x = $array['x'];
		$this->_y = $array['y'];
		$this->_z = $array['z'];
		if (isset($array['w']))
			$this->_w = $array['w'];
		if (isset($array['color']))
			$this->color = $array['color'];
		else
			$this->color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
		if (Vertex::$verbose)
		{
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) constructed\n",
					$this->_x,
					$this->_y,
					$this->_z,
					$this->_w,
					$this->color);
		}
	}

	function __destruct()
	{
		if (Vertex::$verbose)
		{
			printf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) destructed\n",
				$this->_x,
				$this->_y,
				$this->_z,
				$this->_w,
				$this->color);
		}
	}

	function __toString()
	{
		if (Vertex::$verbose)
			return sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) ",
				$this->_x,
				$this->_y,
				$this->_z,
				$this->_w,
				$this->color);
		else
			return sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f ) ",
				$this->_x,
				$this->_y,
				$this->_z,
				$this->_w);
	}

	public static function doc()
	{
		echo "\n";
		$file = file_get_contents("Vertex.doc.txt");
		echo $file;
		echo "\n";
	}
}