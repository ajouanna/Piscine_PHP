<?php
session_start();
include("./globals.php");
$_SESSION['logged_on_user'] = "";
unset($_SESSION['logged_on_user']);
$admin = false;
if ($_SESSION['profil'] == 'admin')
	$admin = true;
$_SESSION['profil'] = 0;
unset($_SESSION['profil']);
header("Location: ".INDEX);
?>
