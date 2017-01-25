#!/usr/bin/php
<?PHP
function coupe($str)
{
	$tok = strtok($str, " ");
	while ($tok !== false)
	{
		$tab[]=$tok;
		$tok = strtok(" ");
	}
	return $tab;
}

if ($argc >= 2)
{
	$mon_tab=coupe($argv[1]);
	$i=1;
	$taille=count($mon_tab);
	while ($i < $taille)
	{
		echo $mon_tab[$i]." ";
		$i++;
	}
	echo $mon_tab[0]."\n";
}
?>
