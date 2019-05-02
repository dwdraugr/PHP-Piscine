<?php
	$login = "zaz";
	$passwd = "jaimelespetitsponeys";
	if ($_SERVER['PHP_AUTH_USER'] === $login && $_SERVER['PHP_AUTH_PW'] === $passwd)
	{
		?><html><body>
Hello Zaz<br />
<?php
		echo "<img src=data:img/png;base64,";
		echo base64_encode(file_get_contents('img/42.png')) . "'>";
?>

</body></html>
<?php
	}
	else
	{
		header("WWW-Authenticate: Basic realm=''Member area''");
		header("HTTP/1.0 401 Unauthorized");
		?>
<html><body>That area is accessible for members only</body></html>
<?php
	}
	?>