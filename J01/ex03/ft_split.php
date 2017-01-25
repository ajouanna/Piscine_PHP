#!/usr/bin/php
<?PHP
// cette fonction decoupe une chaine suivant le separateur espace
// et renvoie un tableau trie
function ft_split($str)
{
	$tok = strtok($str, " ");
	while ($tok !== false) {
		$tab[]=$tok;
		$tok = strtok(" ");
	}
	sort($tab);
	return $tab;
}

?>
