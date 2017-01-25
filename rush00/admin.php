<?php
include("./globals.php");
include("./header.php");
include("./footer.php");
include("./product_admin_view.php");

if (!isset($_SESSION['profil']) || $_SESSION['profil'] != "admin")
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
	$sql = "SELECT * FROM products";
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if (mysqli_num_rows($res) > 0)
	{
		tag("div", "admin_add_div");
		tag("a", "admin_add_product", "./product_form.php");
		echo "Ajouter";
		gat("a");
		gat("div");
		tag("table", "admin_product_table");
		while ($row = mysqli_fetch_assoc($res))
		{
			$id = $row['product_id'];
			$name = $row['name'];
			$artist = $row['artist'];
			$desc = $row['description'];
			$img = $row['img'];
			$price = $row['price'];
			$format = $row['format'];
			$sql = "SELECT genre_name FROM genre WHERE genre_id IN (SELECT genre_id FROM cross_table WHERE product_id=$id)";
			$db_genre = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$genre = [];
			if (mysqli_num_rows($db_genre) > 0)
			{
				while ($genre_row = mysqli_fetch_assoc($db_genre))
					$genre[] = $genre_row['genre_name'];
			}
			product_admin_view($id, $name, $artist, $img, $desc, $price, $format, $genre);
		}
		gat("table");
	}
}
?>

<?php 
	mysqli_close($conn);
	footer();
?>
