<?php
session_start();
include("./globals.php");
$_SESSION['cart_detail'] = null;
$_SESSION['cart'] = null;
unset($_SESSION['cart_detail']);
unset($_SESSION['cart']);
$referer = $_SERVER['HTTP_REFERER'];
if ($referer)
	header("Location: ".$referer);
else
	header("Location: ".INDEX);
?>
