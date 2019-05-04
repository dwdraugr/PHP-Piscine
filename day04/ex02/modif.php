<?php
	if ($_POST['login'] == ""|| $_POST['oldpw'] == "" || $_POST['newpw'] == "") {
		echo("ERROR WHITESPACE\n");
		exit();
	}
	$db = unserialize(file_get_contents("../private/passwd"));
	foreach ($db as $elem)
	{
		if ($elem['login'] == $_POST['login'])
		{
			$oldpw = hash("whirlpool",  $_POST['oldpw']);
			echo($oldpw."<br/>".$elem[passwd]);
			if ($oldpw == $elem['passwd'])
			{
				$elem['passwd'] = hash("whirlpool", $_POST['newpw']);
				echo("OK\n");
				exit();
			}
			else
			{
				echo("ERROR PASSWORD\n");
				exit();
			}
		}
	}
	echo("ERROR USER\n");
?>