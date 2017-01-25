<?php
session_start();
include("./globals.php");
if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] == "")
{
	$referer = $_SERVER['HTTP_REFERER'];
	$_SESSION['status'] = "Vous devez être identifié pour pouvoir valider votre commande";
	if ($referer)
		header("Location: ".$referer);
	else
		header("Location: ".INDEX);
}
else
{
	header("Location: ./cart_validate.php");
}
?>
