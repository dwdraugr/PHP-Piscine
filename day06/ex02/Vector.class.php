<?php

require_once ("Vertex.class.php");

class Vector
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 0.0;
	public static $verbose = FALSE;

	public function __construct(array $array)
	{
		$dest = $array['dest'];
		if ($array['orig'] instanceof Vertex)
			$orig = new Vertex(array(
				'x' => $array['orig']->_x,
				'y' => $array['orig']->_y,
				'z' => $array['orig']->_z
			));
		else
			$orig = new Vertex(array(
				'x' => 0.0,
				'y' => 0.0,
				'z' => 0.0
			));
		$this->_x = $dest->_x - $orig->_x;
		$this->_y = $dest->_y - $orig->_y;
		$this->_z = $dest->_z - $orig->_z;
		if (Vector::$verbose)
			printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) constructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w);
	}

	function __destruct()
	{
		if (Vector::$verbose)
			printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) destructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w);
	}

	public function __get($property)
	{
		if (property_exists($this, $property))
			return $this->$property;
	}

	function __toString()
	{
		if (Vector::$verbose)
			return sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )",
				$this->_x, $this->_y, $this->_z, $this->_w);
	}

	public static function doc()
	{
		echo "\n";
		$file = file_get_contents("Vector.doc.txt");
		echo $file;
		echo "\n";
	}

	public function magnitude()
	{
		$length = sqrt($this->_x ** 2 + $this->_y ** 2 + $this->_z ** 2);
		return $length;
	}

	public function normalize()
	{
		$length = $this->magnitude();
		if ($length == 1)
			return clone $this;
		else
		{
			return new Vector(array('dest' => new Vertex(array(
				'x' => $this->_x / $length,
				'y' => $this->_y / $length,
				'z' => $this->_z / $length
			))));
		}
	}

	public function add(Vector $rhs)
	{
		$sum_x = $this->_x + $rhs->_x;
		$sum_y = $this->_y + $rhs->_y;
		$sum_z = $this->_z + $rhs->_z;
		return new Vector(array('dest' => new Vertex(array(
			'x' => $sum_x,
			'y' => $sum_y,
			'z' => $sum_z,
		))));
	}

	public function sub(Vector $rhs)
	{
		$sub_x = $this->_x - $rhs->_x;
		$sub_y = $this->_y - $rhs->_y;
		$sub_z = $this->_z - $rhs->_z;
		return new Vector(array('dest' => new Vertex(array(
			'x' => $sub_x,
			'y' => $sub_y,
			'z' => $sub_z,
		))));
	}

	public function opposite()
	{
		return new Vector(array('dest' => new Vertex(array(
			'x' => -$this->_x,
			'y' => -$this->_y,
			'z' => -$this->_z,
		))));
	}

	public function scalarProduct($k)
	{
		return new Vector(array('dest' => new Vertex(array(
			'x' => $this->_x * $k,
			'y' => $this->_y * $k,
			'z' => $this->_z * $k,
		))));
	}

	public function dotProduct(Vector $rhs)
	{
		return $this->_x * $rhs->_x +
			$this->_y * $rhs->_y +
			$this->_z * $rhs->_z;
	}

	public function cos(Vector $rhs)
	{
		return ($this->_x * $rhs->_x +
				$this->_y * $rhs->_y +
				$this->_z * $rhs->_z)
				/
				(sqrt($this->_x ** 2 + $this->_y ** 2 + $this->_z ** 2) *
				 sqrt($rhs->_x ** 2 + $rhs->_y ** 2 + $rhs->_z ** 2));
	}
	public function crossProduct(Vector $rhs)
	{
		return new Vector(array('dest' => new Vertex(array(
			'x' => $this->_y * $rhs->_z - $this->_z * $rhs->_y,
			'y' => $this->_z * $rhs->_x - $this->_x * $rhs->_z,
			'z' => $this->_x * $rhs->_y - $this->_y * $rhs->_x,
		))));
	}
}