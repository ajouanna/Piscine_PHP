#!/usr/bin/php
<?php
if ($argc > 1)
{
	$str=trim($argv[1]," \t");
	$tok = strtok($str, " \t");
	$first_time=true;
	while ($tok !== false) {
		if ($first_time == true)
		{
			$first_time=false;
		}
		else
		{
			echo " ";
		}
		echo $tok;
		$tok = strtok(" \t");
	}
	echo "\n";
}


?>
