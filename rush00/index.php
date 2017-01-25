<?php
include("./globals.php");
include("./header.php");
include("./footer.php");
include("./product_view.php");

function category_view($arr_category)
{
	tag("div", "category_list");
	echo "Catégories :";
	tag("a", "category_a", "./index.php");
	tag("span", "category_item");
	echo "Toutes";
	gat("span");
	gat("a");
	foreach ($arr_category as $id => $cat)
	{
		echo " ";
		tag("a", "category_a", "./index.php?category=$id");
		tag("span", "category_item");
		echo $cat;
		gat("span");
		gat("a");
	}
	echo("<hr/>");
	gat("div");
}
?>

<?php
$cat_list = [];
$sql = "SELECT genre_id, genre_name FROM genre";
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
if (mysqli_num_rows($res) > 0)
{
	while ($row = mysqli_fetch_assoc($res))
		$cat_list[$row['genre_id']] = $row['genre_name'];
}
category_view($cat_list);
?>

<div class="product_list">
<?php
if (isset($_GET['category']))
{
	$cat = (string)intval($_GET['category']);
	$sql = "SELECT * FROM products WHERE product_id IN (SELECT product_id FROM cross_table WHERE genre_id=$cat)";
}
else
{
	$sql = "SELECT * FROM products";
}
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
if (mysqli_num_rows($res) > 0)
{
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
		product_view($id, $name, $artist, $img, $desc, $price, $format, $genre);
	}
}
?>
</div>

<?php 
	mysqli_close($conn);
	footer();
?>
