#!/usr/bin/php
<?PHP
if ($argc == 2)
{
	$str=trim($argv[1]," ");
	$tok = strtok($str, " ");
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
		$tok = strtok(" ");
	}
	echo "\n";
}
?>
