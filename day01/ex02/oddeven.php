<?php
	while (1) {
		echo("Enter a value : ");
		$num = trim(fgets(STDIN));
		if (feof(STDIN)) {
			echo("\n");
			exit();
		}
		if (is_numeric($num)) {
			if ($num % 2 == 0)
				echo("The number " . $num . " is even\n");
			else
				echo("The number " . $num . " is odd\n");
		}
		else
			echo("'".$num."' is not a number\n");
	}
?>
