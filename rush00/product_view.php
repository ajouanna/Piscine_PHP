<?php
include("./html.php");

function product_view($id, $name, $artist, $img, $desc, $price, $format, $genre)
{
	tag("div", "product"); 
	tag("div","product_left");
	$img = $img ? $img : "https://cdn.pixabay.com/photo/2014/04/03/11/36/cd-311951_960_720.png";
	tag("img", "product_img", $img, $name, $name);
	gat("div");
	tag("div","product_right");
	tag("div", "product_name");
	echo $name;
	gat("div");
	tag("div", "product_artist");
	echo $artist;
	gat("div");
	tag("div", "product_format");
	echo $format;
	gat("div");
	tag("div", "product_genre");
	echo implode(", ", $genre);
	gat("div");
	tag("div", "product_price");
	echo $price."€";
	gat("div");
	echo "<br/>";
	tag("div", "product_desc");
	echo $desc;
	gat("div");
	tag("a", "product_addtocart", "./add_to_cart.php?id=".$id);
	echo "Ajouter au panier";
	gat("a");
	gat("div");
	gat("div");
	echo("<hr/>");

}
?>
