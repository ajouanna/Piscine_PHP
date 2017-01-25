<?php
switch ($_GET['action'])
{
	case "set":
		// creer un cookie
		setcookie($_GET['name'], $_GET['value'], time()+3600);
		break;
	case "get":
		if ($_COOKIE[$_GET['name']])
		{
			echo ($_COOKIE[$_GET['name']]);
			echo "\n";
		}
		break;
	case "del":
		setcookie($_GET['name'], "", time()-3600);
		break;
	case "getall":
		echo "liste des cookies:";
		print_r($_COOKIE);
}
?>
