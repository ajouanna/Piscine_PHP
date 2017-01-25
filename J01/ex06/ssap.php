#!/usr/bin/php
<?PHP
function ft_split($str)
{
	$tok = strtok($str, " ");
	while ($tok !== false)
	{
		$tab[]=$tok;
		$tok = strtok(" ");
	}
	sort($tab);
	return $tab;
}

if ($argc >= 2)
{
	$i=1;
	while ($i < $argc)
	{
		$tout .= " ".$argv[$i];
		$i++;
	}
	$mon_tab=ft_split($tout);
	foreach ($mon_tab as $elem)
	{
		echo $elem."\n";
	}
}
?>
