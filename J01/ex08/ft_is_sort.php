#!/usr/bin/php
<?PHP
function ft_is_sort($tab)
{
	$copie=$tab;
	sort($tab);
	if ($tab === $copie)
		return true;
	else
		return false;
}
?>
