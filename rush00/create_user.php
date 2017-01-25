<?php
include("./globals.php");
session_start();

function get_passwd($path, $passfile)
{
	$arr = [];
	if (!file_exists($path))
		mkdir($path);
	if (file_exists($passfile))
	{
		$str = file_get_contents($passfile);
		if ($str)
			$arr = unserialize($str);
	}
	return ($arr);
}

function add_passwd($path, $passfile, $login, $passwd)
{
	if ($login === null || $passwd === null)
		return (false);
	$arr = get_passwd($path, $passfile);
	foreach($arr as &$el)
	{
		if ($el['login'] === $login)
			return (false);
	}
	$new['login'] = $login;
	$new['profil'] = "user";
	$new['passwd'] = hash("whirlpool", $passwd);
	$arr[] = $new;
	$stuff = serialize($arr);
	if (file_put_contents($passfile, $stuff))
		return (true);
	else
		return (false);
}

$path = "./db";
$passfile = PASSFILE;
$login = $_POST['login'];
$passwd = $_POST['passwd'];
$submit = $_POST['submit'];

if (add_passwd($path, $passfile, $login, $passwd))
{
	$_SESSION['logged_on_user'] = $login;
	$_SESSION['status'] = "";
	header("Location: ".INDEX);
}
else
{
	$_SESSION['status'] = "Le compte n'a pas pu &ecirc;tre créé";
	header("Location: ./user_creation.php");
}
?>
