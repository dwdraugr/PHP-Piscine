<?php


class Jaime extends Lannister
{
	public function With($obj_class)
	{
		if (get_parent_class($obj_class) !== "Lannister")
		{
			return("Let's do this");
		}
		elseif (get_class($obj_class) === "Cersei")
		{
			return("With pleasure, but only in a tower in Winterfell, then.");
		}
		else
		{
			return ("Not even if I'm drunk !");
		}
	}
}