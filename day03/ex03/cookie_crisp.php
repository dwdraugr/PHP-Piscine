<?php
	switch ($_GET['action'])
	{
		case "set":
			setcookie($_GET['name'], $_GET['value'], time() + (86400 * 30));
			break;
		case "get":
			if ($_COOKIE[$_GET['name']] != "")
				echo $_COOKIE[$_GET['name']];
			break;
		case "del":
			setcookie($_GET['name'], "", -1);
			break;
	}
?>