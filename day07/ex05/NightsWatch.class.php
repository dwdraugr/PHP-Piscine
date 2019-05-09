<?php


class NightsWatch
{
	private $fighters;

	public function __construct()
	{
		$fighters = array();
	}
	public function recruit($nw)
	{
		$this->fighters[] = $nw;
	}
	public function fight()
	{
		foreach ($this->fighters as $f)
		{
			$interf = class_implements($f);
			if (isset($interf['IFighter']))
				$f->fight();
		}
	}
}