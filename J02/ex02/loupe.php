#!/usr/bin/php
<?PHP

function loupe2($matches2)
{
	// je reconstitue une chaine avec les elements recuperes de l'appel
	// de loupe1, en passant en majuscule celui en position 2
	// qui est le texte cherche
	//echo "DEBUG loupe2 :\n";
	//print_r($matches2);
	$str = $matches2[1].strtoupper($matches2[2]).$matches2[3];
	//echo "DEBUG loupe2 : $str\n";
	return ($str);
}

function loupe1($matches1)
{
	//je cherche un chevron de fermeture et/ou une balise HTML TITLE
	//echo "DEBUG loupe1 :\n";
	//print_r($matches1);
	$pattern1=array('/(>)(.*?)(<)/s', '/(TITLE=")(.*?)(")/si');
	$str = preg_replace_callback( $pattern1, "loupe2", $matches1[0]);
	return ($str);
};

if ($argc != 2)
{
	echo "Usage : loupe.php nom_fichier\n";
	exit;
}
if (is_readable($argv[1]) == false)
{
	echo "File $argv[1] cannot be read\n";
	exit;
}
$file_str=file_get_contents($argv[1]);


$pattern = '/<A href=(.*?)>(.*?)<\/A>/si';
// je cheche tous les liens html, balise HTML A
$str = preg_replace_callback($pattern, "loupe1", $file_str);
echo $str;
?>
