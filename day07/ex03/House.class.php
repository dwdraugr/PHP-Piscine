<?php


abstract class House
{
	abstract public function getHouseName();
	abstract public function getHouseMotto();
	abstract function getHouseSeat();
	public function introduce()
	{
		printf("House %s of %s : \"%s\"\n",
			$this->getHouseName(),
			$this->getHouseSeat(),
			$this->getHouseMotto());
	}
}