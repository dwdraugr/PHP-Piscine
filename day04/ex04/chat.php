<?php
	header('Content-Type: text/plain');
	session_start();
		if (!($_SESSION['loggued_on_user']))
			echo "ERROR\n";
		else {
			if (file_exists('../private') && file_exists('../private/chat')) {
				$chat = unserialize(file_get_contents('../private/chat'));
				date_default_timezone_set("Europe/Moscow");
				foreach ($chat as $v) {
					echo "[" . date('H:i', $v['time']) . "] " . $v['login'] . "::\t".  $v['msg'] . "\n";
				}
			}
}