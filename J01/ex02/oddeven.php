#!/usr/bin/php
<?PHP

while (true)
{
	echo "Entrez un nombre: ";
	$sais=fgets(STDIN);
	if ($sais == false)
	{
		echo "\n";
		exit;
	}
	$saisie=trim($sais," \t\n\r");
	if (is_numeric($saisie))
	{
		$nbre=intval($saisie);
		if ($nbre % 2 == 0)
		{
			echo "Le chiffre $nbre est Pair\n";
		}
		else
		{
			echo "Le chiffre $nbre est Impair\n";
		}
	}
	else
	{
		echo "'$saisie' n'est pas un chiffre\n";
	}

}
?>
