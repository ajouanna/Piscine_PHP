<?php
include("./html.php");

function product_admin_view($id, $name, $artist, $img, $desc, $price, $format, $genre)
{
	tag("tr", "admin_product");

	tag("td");
	echo $id;
	gat("td");

	tag("td");
	$img = $img ? $img : "https://cdn.pixabay.com/photo/2014/04/03/11/36/cd-311951_960_720.png";
	tag("img", "admin_product_img", $img, $name, $name);
	gat("td");

	tag("td");
	echo $name;
	gat("td");

	tag("td");
	echo $artist;
	gat("td");

	tag("td");
	echo $format;
	gat("td");

	tag("td");
	echo implode(", ", $genre);
	gat("td");

	tag("td");
	echo $price."€";
	gat("td");

	tag("td");
	echo $desc;
	gat("td");

	tag("td");
	tag("a", "", "./product_form.php?id=$id");
	echo "Modifier";
	gat("a");
	gat("td");

	tag("td");
	tag("a", "", "./product_delete.php?id=$id");
	echo "Supprimer";
	gat("a");
	gat("td");

	gat("tr");
}
?>
