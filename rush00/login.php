<?php
session_start();
include("./globals.php");

function auth($login, $passwd, $passfile)
{
	$arr = [];

	if ($login === "" || $passwd === "")
		return (0);
	$str = file_get_contents($passfile);
	if ($str)
		$arr = unserialize($str);
	else
		return (0);
	foreach($arr as &$el)
	{
		if ($el['login'] === $login)
		{
			if (hash("whirlpool", $passwd) === $el['passwd'])
			{
				if ($el['profil'] === "admin")
					return (2);
				else
					return (1);
			}
			else
				return (0);
		}
	}
	return (0);
}

$login = $_POST['login'];
$passwd = $_POST['passwd'];
$submit = $_POST['submit'];
$user_type = auth($login, $passwd, PASSFILE);
if ($user_type == 2)
{
	$_SESSION['logged_on_user'] = $login;
	$_SESSION['status'] = "";
	$_SESSION['profil'] = "admin";
}
else if ($user_type == 1)
{
	$_SESSION['logged_on_user'] = $login;
	$_SESSION['status'] = "";
	$_SESSION['profil'] = "user";
}
else
{
	$_SESSION['status'] = "Mauvais login ou mot de passe";
}
$referer = $_SERVER['HTTP_REFERER'];
if ($referer)
	header("Location: ".$referer);
else
	header("Location: ".INDEX);
?>
