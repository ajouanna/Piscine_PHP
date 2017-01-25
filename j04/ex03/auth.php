<?PHP
function auth($login, $passwd)
{
  $dir="../private";
	$filename=$dir."/passwd";

	// verifier l'existence du fichier passwd
	if (!file_exists($filename))
	{
		return false;
	}

	$tabsecurite=unserialize(file_get_contents($filename));
  $hash_str=hash("whirlpool",$passwd);

	foreach ($tabsecurite as $key => $element)
	{
		if ($element['login'] === $login && $hash_str === $element["passwd"])
		{
			return true;
		}
	}
	return false;
}
?>
