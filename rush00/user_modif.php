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

function update_passwd($passfile, $login, $oldpw, $newpw, $repw)
{
	if ($login === "" || $oldpw === "" || $newpw === "" || $repw === "")
	{
		$_SESSION['status'] = "Les champs ne peuvent pas être vides";
		return (false);
	}
	if (hash("whirlpool", $newpw) != hash("whirlpool", $repw))
	{
		$_SESSION['status'] = "Le mot de passe et la confirmation ne correspondent pas";
		return (false);
	}
	$arr = get_passwd($passfile);
	foreach($arr as &$el)
	{
		if ($el['login'] === $login)
		{
			if (hash("whirlpool", $oldpw) === $el['passwd'])
			{
				$el['passwd'] = hash("whirlpool", $newpw);
				if (file_put_contents($passfile, serialize($arr)))
				{
					return (true);
				}
				else
				{
					$_SESSION['status'] = "Erreur lors de la modification du mot de passe";
					return (false);
				}
			}
			else
			{
				$_SESSION['status'] = "Erreur lors de la modification du mot de passe";
				return (false);
			}
		}
	}
	return (false);
}
$login = $_SESSION['logged_on_user'];
$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];
$repw = $_POST['repw'];
$submit = $_POST['submit'];

if ($submit === "OK")
{
	if (update_passwd(PASSFILE, $login, $oldpw, $newpw, $repw))
		$_SESSION['status'] = "Le mot de passe a été modifié avec succès";
	header("Location: ./user_account.php");
}
