<?php
include("./header.php");
include("./footer.php");
include("./html.php");
$referer = $_SERVER['HTTP_REFERER'];
$referer_page = preg_split("/\//", $referer);
if (trim(end($referer_page)) !== "panier.php")
{
	tag("div", "error");
	echo "Erreur";
	tag("a", "error_link", "index.php");
	echo "Retour à la page d'accueil";
	gat("a");
	gat("div");
}
else
{
	$user_name = mysqli_real_escape_string($conn, $_SESSION['logged_on_user']);
	$cart_content = serialize($_SESSION['cart_detail']);
	$cart_content = mysqli_real_escape_string($conn, $cart_content);
	$sql = "INSERT into carts (user_name, cart_content) values ('$user_name', '$cart_content')";
	mysqli_query($conn, $sql) or die(mysqli_error($conn));
	unset($_SESSION['cart_detail']);
	unset($_SESSION['cart']);
	tag("div", "cart_validated");
	echo "La commande a été enregistrée";
	gat("div");
	tag("a", "home", "./index.php");
	echo "Retour à la page d'accueil";
	gat("a");
}
mysqli_close($conn);
footer();
?>
