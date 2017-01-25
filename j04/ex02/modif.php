<?php
// session_start(); // pas de session dans cet exercice
function print_error()
{
	echo "ERROR\n";
	exit;
}
// tester si les parametres login et passwd sont bien presents
if (!isset($_POST["login"]) || !isset($_POST["oldpw"]) || !isset($_POST["newpw"]))
	print_error();

// tester si leur valeur n'est pas nulle
if (!$_POST["login"] || !$_POST["oldpw"] || !$_POST["newpw"])
	print_error();

// tester que sumit vaut bien OK
if (isset($_POST['submit']) && $_POST['submit'] == "OK")
{
	$dir="../private";
	$filename=$dir."/passwd";

	// verifier l'existence du fichier passwd
	if (!file_exists($filename))
	{
		print_error();
	}

	$tabsecurite=unserialize(file_get_contents($filename));
	$found = false;
	foreach ($tabsecurite as $key => $element)
	{
		if ($element['login'] === $_POST['login'])
		{
			$found = true;
			$found_key = $key;
			break;
		}
	}
	if ($found == false)
	{
		print_error(); // on s arrete ici
	}
	$hash_str=hash("whirlpool",$_POST["oldpw"]);
	if ($hash_str !== $element["passwd"])
	{
		print_error(); // on s arrete ici
	}

	// ici on a trouve l'ancien pwd, on va le modifier
	$tabsecurite[$found_key]["passwd"]= hash("whirlpool",$_POST["newpw"]);
	$str=serialize($tabsecurite);
	file_put_contents($filename,$str);
	echo "OK\n";
}
else
{
	print_error();
}
?>
