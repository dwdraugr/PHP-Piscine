<?php


class Tyrion extends Lannister
{
	public function With($obj_class)
	{
		if (get_parent_class($obj_class) !== "Lannister")
		{
			return("Let's do this");
		}
		else
		{
			return ("Not even if I'm drunk !");
		}
	}
}