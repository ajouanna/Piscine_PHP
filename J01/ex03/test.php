#!/usr/bin/php
<?PHP
include("ft_split.php");

if ($argc == 2)
{
	print_r(ft_split($argv[1]));
}
else {
	echo "Usage : test.php chaine_a_traiter\n";
}
?>
