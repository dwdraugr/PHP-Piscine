<?php

require_once ("Vector.class.php");

class Matrix
{
	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE";
	const RX = "Ox ROTATION";
	const RY = "Oy ROTATION";
	const RZ = "Oz ROTATION";
	const TRANSLATION = "TRANSLATION";
	const PROJECTION = "PROJECTION";

	protected $_matrix;
	public static $verbose = FALSE;

	public function __construct(array $arr)
	{
		$this->_matrix = self::init_matrix();
//		if (self::$verbose) {
//			if ($this->_matrix == self::IDENTITY)
//				echo "Matrix " . $this->_matrix . " instance constructed\n";
//			else
//				echo "Matrix " . $this->_matrix . " preset instance constructed\n";
//		}
		switch ($arr['preset']) {
			case self::IDENTITY:
				$str = self::IDENTITY;
				break;
			case self::SCALE:
				$str = self::SCALE;
				self::scale_construct($this->_matrix, $arr['scale']);
				break;
			case self::RX:
				$str = self::RX;
				self::angle_construct($this->_matrix, $arr['angle'], self::RX);
				break;
			case self::RY:
				$str = self::RY;
				self::angle_construct($this->_matrix, $arr['angle'], self::RY);
				break;
			case self::RZ:
				$str = self::RZ;
				self::angle_construct($this->_matrix, $arr['angle'], self::RZ);
				break;
			case self::TRANSLATION:
				$str = self::TRANSLATION;
				self::translation_construct($this->_matrix, $arr['vtc']);
				break;
			case self::PROJECTION:
				$str = self::PROJECTION;
				self::projection_construct(	 $this->_matrix
				                            ,$arr['fov']
											,$arr['ratio']
											,$arr['near']
											,$arr['far']);
				break;
		}
		if (self::$verbose) {
			if ($str == self::IDENTITY)
				echo "Matrix " . $str . " instance constructed\n";
			else
				echo "Matrix " . $str . " preset instance constructed\n";
		}
	}
	function __destruct()
	{
		if (self::$verbose)
			printf("Matrix instance destructed\n");
	}
	private static function init_matrix()
	{
		return array(
			array(1.0, 0.0, 0.0, 0.0),
			array(0.0, 1.0, 0.0, 0.0),
			array(0.0, 0.0, 1.0, 0.0),
			array(0.0, 0.0, 0.0, 1.0),
		);
	}
	private static function scale_construct(&$matrix, $scale)
	{
		$matrix[0][0] = $scale;
		$matrix[1][1] = $scale;
		$matrix[2][2] = $scale;
		$matrix[3][3] = 1;
	}
	private static function angle_construct(&$matrix, $angle, $axis)
	{
		switch ($axis){
			case self::RX:
				$matrix[0][0] =  1;
				$matrix[1][1] =  cos($angle);
				$matrix[1][2] = -sin($angle);
				$matrix[2][1] =  sin($angle);
				$matrix[2][2] =  cos($angle);
				$matrix[3][3] =  1;
				break;
			case self::RY:
				$matrix[0][0] =  cos($angle);
				$matrix[0][2] =  sin($angle);
				$matrix[1][1] =  1;
				$matrix[2][0] = -sin($angle);
				$matrix[2][2] =  cos($angle);
				$matrix[3][3] =  1;
				break;
			case self::RZ:
				$matrix[0][0] =  cos($angle);
				$matrix[0][1] = -sin($angle);
				$matrix[1][0] =  sin($angle);
				$matrix[1][1] =  cos($angle);
				$matrix[2][2] =  1;
				$matrix[3][3] =  1;
				break;
		}
	}
	private static function translation_construct(&$matrix, Vector $vtc)
	{
		$matrix[0][3] = $vtc->_x;
		$matrix[1][3] = $vtc->_y;
		$matrix[2][3] = $vtc->_z;
	}
	private static function projection_construct(&$matrix, $fov, $ratio, $near, $far)
	{
		$matrix[1][1] = 1 / tan(0.5 * deg2rad($fov));
		$matrix[0][0] = $matrix[1][1] / $ratio;
		$matrix[2][2] = -1 * (-$near - $far) / ($near - $far);
		$matrix[3][2] = -1;
		$matrix[2][3] = (2 * $near * $far) / ($near - $far);
		$matrix[3][3] = 0;

	}
	public static function doc()
	{
		echo "\n";
		$file = file_get_contents("Matrix.doc.txt");
		echo $file;
		echo "\n";
	}
	function __toString()
	{
		$mass = "";
		$mass .= "M | vtcX | vtcY | vtcZ | vtxO\n";
		$mass .= "-----------------------------\n";
		$mass .= sprintf("x | %.2f | %.2f | %.2f | %.2f\n", 	 $this->_matrix[0][0]
															,$this->_matrix[0][1]
															,$this->_matrix[0][2]
															,$this->_matrix[0][3]);
		$mass .= sprintf("y | %.2f | %.2f | %.2f | %.2f\n", 	 $this->_matrix[1][0]
															,$this->_matrix[1][1]
															,$this->_matrix[1][2]
															,$this->_matrix[1][3]);
		$mass .= sprintf("z | %.2f | %.2f | %.2f | %.2f\n", 	 $this->_matrix[2][0]
															,$this->_matrix[2][1]
															,$this->_matrix[2][2]
															,$this->_matrix[2][3]);
		$mass .= sprintf("w | %.2f | %.2f | %.2f | %.2f", 	 $this->_matrix[3][0]
															,$this->_matrix[3][1]
															,$this->_matrix[3][2]
															,$this->_matrix[3][3]);
		return $mass;
	}
	public function mult(Matrix $rhs)
	{
		$new = new Matrix(array('preset' => Matrix::IDENTITY));
		for ($i = 0; $i < 4; $i++)
			for ($j = 0; $j < 4; $j++)
			{
				$new->_matrix[$i][$j] = 0;
				for ($k = 0; $k < 4; $k++) {
					$new->_matrix[$i][$j] = $this->_matrix[$i][$k] + $rhs->_matrix[$k][$j];
				}
			}

		return $new;
	}
	public function transformVertex(Vertex $vtx)
	{
		$tmp = array(
			'x' => $vtx->_x * $this->_matrix[0][0] + $vtx->_y * $this->_matrix[0][1] + $vtx->_z * $this->_matrix[0][2] + $vtx->_w * $this->_matrix[0][3],
			'y' => $vtx->_x * $this->_matrix[1][0] + $vtx->_y * $this->_matrix[1][1] + $vtx->_z * $this->_matrix[1][2] + $vtx->_w * $this->_matrix[1][3],
			'z' => $vtx->_x * $this->_matrix[2][0] + $vtx->_y * $this->_matrix[2][1] + $vtx->_z * $this->_matrix[2][2] + $vtx->_w * $this->_matrix[2][3],
			'w' => $vtx->_x * $this->_matrix[3][0] + $vtx->_y * $this->_matrix[3][1] + $vtx->_z * $this->_matrix[3][2] + $vtx->_w * $this->_matrix[3][3],
			'color' => $vtx->_color);
		$vert = new Vertex($tmp);
		return $vert;
	}
}
