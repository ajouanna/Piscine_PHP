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
	return $tab;
}

function valeur_diff($car1, $car2)
{
	// la logique : alpha < digit < autre
	if (ctype_alpha($car1))
	{
		if (ctype_alpha($car2))
		{
			// la casse ne doit pas etre prise en compte
			$upcar1=strtoupper($car1);
			$upcar2=strtoupper($car2);
			return (ord($upcar1) - ord($upcar2));
		}
		else
			return -1;
	}
	if (ctype_digit($car1))
	{
		if (ctype_alpha($car2))
		{
			return 1;
		}
		if (ctype_digit($car2))
		{
			return (ord($car1) - ord($car2));
		}
		return -1;
	}
	// ici je sais que car1 n est pas un alpha num
	if (ctype_alpha($car2) || ctype_digit($car2))
	{
		return 1;
	}
return (ord($car1) - ord($car2));
}


function mon_tri($str1, $str2)
{
	if ($str1 == $str2)
		return 0;
	// transformer les chaines en tableaux
	$len1=strlen($str1);
	$len2=strlen($str2);
	$i=0;
	while ($i < $len1 && $i < $len2)
	{
		$diff=valeur_diff($str1[$i],$str2[$i]);
		if ($diff != 0)
			return $diff;
		$i++;
	}
	return ($len1 - $len2);
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
	// a ce point j ai un tableau non trie avec tous les parametres
	// je vais appliquer un algo de tri qui traite les lettres puis les chiffres
	// puis tout le reste

	usort($mon_tab, "mon_tri");
	foreach ($mon_tab as $elem)
	{
		echo "$elem\n";
	}
}
?>
