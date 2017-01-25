<?php
session_start();
include("./globals.php");

function user_logged()
{
	echo "<div class=\"user_logged\">Bonjour <b>".$_SESSION['logged_on_user']."</b></div>\n";
	echo "<br/><a href=\"./logout.php\">Se d&eacute;connecter</a>";
	echo "<br/><a href=\"./user_account.php\">Mon compte</a>";
}

function user_notlogged()
{
	echo "<form action=\"./login.php\" method=\"post\">\n";
	echo "<label>Identifiant:</label><input name=\"login\"/>\n";
	echo "	<br />\n";
	echo "<label>Mot de passe:</label><input name=\"passwd\" type=\"password\"/>\n";
	echo "	<input type=\"submit\" name=\"submit\" value=\"OK\"/>\n";
	echo "</form>\n";
	echo "<div>";
	echo "<a class=\"new_account\" href=\"./user_creation.php\">Créer un compte</a>";
	echo "</div>";
}

function admin_page()
{
	echo "<div>";
	echo "<a class=\"admin_page\" href=\"./admin.php\">Admin</a>";
	echo "</div>";
}

function print_user_auth()
{
	if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] === "")
		user_notlogged();
	else
		user_logged();
	if ($_SESSION['profil'] === "admin")
		admin_page();
}

function print_status()
{
	if ($_SESSION['status'] !== "")
		echo $_SESSION['status'];
}
$servername = "localhost";
$username = "root";
$password = "root";
$db_name = "musicstore";

$conn = mysqli_connect($servername, $username, $password, $db_name);
if (!$conn)
	die("Connection failed: " . mysqli_connect_error());
mysqli_set_charset($conn, "utf8");
?>
<html>
	<head>
		<link rel="stylesheet" type "text/css" href="42musicstore.css">
		<title>42 Music Store</title>
	</head>

<body>
<div class="header">
		<div class="logo">
<a href="./index.php">
			<img class="logo_img" src="img/42musicstore.jpg" alt="42 Music" title="42 Music"/>
</a>
		</div>
<div class="header_right">
		<div class="user_auth">
			<?php print_user_auth(); ?>
		</div>
		<div class="header_cart">
		<img border="0" alt="Panier" src="http://fla.fg-a.com/shopping-cart/shopping-cart-black-3.png">
			<a href="./panier.php"><br />Panier</a>
		</div>
		</div>
		<div class="status">
			<?php print_status(); ?>
		</div>
</div>
<hr />
