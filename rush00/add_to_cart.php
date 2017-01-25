<?php
session_start();
$id = $_GET['id'];
$_SESSION['cart'][] = $id;
$referer = $_SERVER['HTTP_REFERER'];
if ($referer)
	header("Location: ".$referer);
else
	header("Location: ".INDEX);
?>
