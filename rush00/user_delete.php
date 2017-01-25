<?php
include("./globals.php");
session_start();
$current_user = $_SESSION['logged_on_user'];
if ($current_user == "")
	header("Location: ./index.php");

function get_passwd($passfile)
{
	$arr = [];
	$str = file_get_contents($passfile);
	if ($str)
		$arr = unserialize($str);
	return ($arr);
}

function delete_passwd($passfile, $login, $passwd)
{
	if ($login === "" || $passwd === "")
	{
		$_SESSION['status'] = "Les champs ne peuvent pas être vides";
		return (false);
	}
	$arr = get_passwd($passfile);
	foreach($arr as $key => $el)
	{
		if ($el['login'] === $login)
		{
			if (hash("whirlpool", $passwd) === $el['passwd'])
			{
				unset($arr[$key]);
				if (0 < file_put_contents($passfile, serialize($arr)))
					return (true);
				else
					return (false);
			}
			else
			{
				$_SESSION['status'] = "Mot de passe incorrect";
				return (false);
			}
		}
	}
	return (false);
}
$login = $_SESSION['logged_on_user'];
$passwd = $_POST['passwd'];

if (delete_passwd(PASSFILE, $login, $passwd))
{
	$_SESSION['logged_on_user'] = "";
	unset($_SESSION['logged_on_user']);
	$admin = false;
	if ($_SESSION['profil'] == 'admin')
		$admin = true;
	$_SESSION['profil'] = 0;
	unset($_SESSION['profil']);
	$_SESSION['status'] = "Votre compte a été supprimé avec succès";
	header("Location: ./index.php");
}
header("Location: ./user_account.php");
?>
