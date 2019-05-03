<?php
	if ($_POST['login'] == ""|| $_POST['passwd'] == "") {
		echo("ERROR\n");
		exit();
	}
	if  (file_exists("private/passwd")) {
		$elem = unserialize(file_get_contents("private/passwd"));
		foreach ($elem as $e) {
			if ($e['login'] == $_POST['login']) {
				echo("ERROR\n");
				exit();
			}
		}
	}
	if (file_exists("private/passwd")) {
		$db = unserialize(file_get_contents("private/passwd"));
		$login = $_POST['login'];
		$passwd = hash("whirlpool", $_POST['passwd']);
		$elem['login'] = $login;
		$elem['passwd'] = $passwd;
		$db[] = $elem;
		file_put_contents("private/passwd", serialize($db));
		echo("OK\n");
	} else {
		mkdir("private", 0700);
		$login = $_POST['login'];
		$passwd = hash("whirlpool", $_POST['passwd']);
		$elem['login'] = $login;
		$elem['passwd'] = $passwd;
		$db[] = $elem;
		file_put_contents("private/passwd", serialize($db));
		echo("OK\n");
	}
?>