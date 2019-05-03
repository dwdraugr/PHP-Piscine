<?php
	function auth($login, $passwd)
	{
		if  (file_exists("private/passwd")) {
			$elem = unserialize(file_get_contents("private/passwd"));
			foreach ($elem as $e) {
				if ($e['login'] == $login) {
					if ($e['passwd'] == hash("whirlpool", $passwd));
					{
						return TRUE;
					}
				}
			}
		}
		return FALSE;
	}
?>