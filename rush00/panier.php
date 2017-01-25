<?php
include("./globals.php");
include("./header.php");
include("./footer.php");
include("./html.php");

tag("div", "cart");
if (count($_SESSION['cart']) == 0)
{
	tag("div", "cart_empty");
	echo "Votre panier est vide";
	gat("div");
}
else
{
	/*
	echo "cart:\n";
	print_r($_SESSION['cart']);
	print_r(array_count_values($_SESSION['cart']));
	 */
	$cart = $_SESSION['cart'];
	$cart_detail = [];
	$unique_item = array_unique($cart);
	$item_count = array_count_values($cart);
	foreach ($unique_item as $item)
	{
		$new_item = [];
		$new_item['product_id'] = $item;
		$new_item['quantity'] = $item_count[$item];
		$sql = "SELECT name, artist, img, price, format FROM products WHERE product_id=$item";
		$res = mysqli_query($conn, $sql) or die(mysqli_erro($conn));
		if (mysqli_num_rows($res) > 0)
		{
			while ($row = mysqli_fetch_assoc($res))
			{
				$new_item['name'] = $row['name'];
				$new_item['artist'] = $row['artist'];
				$new_item['img'] = $row['img'];
				$new_item['price'] = $row['price'];
				$new_item['total_price'] = $row['price'] * $new_item['quantity'];
				$new_item['format'] = $row['format'];
			}
			$cart_detail[] = $new_item;
		}
	}
	/*
	echo "cart detail:";
	tag("br");
	print_r($cart_detail);
	 */
	tag("table", "cart_table");

		tag("tr", "cart_description");
			tag("td");
			echo "Produit";
			gat("td");

			tag("td");
			echo "Quantité";
			gat("td");

			tag("td");
			echo "Prix";
			gat("td");
		gat("tr");

		foreach($cart_detail as $item)
		{
			tag("tr", "cart_row");
				tag("td", "cart_item");
				tag("div", "cart_item_product");

					tag("div", "cart_item_img_container");
					tag("img", "cart_item_img", $item['img']);
					gat("div");

					tag("div", "cart_item_elem");
					echo $item['name'];
					gat("div");

					tag("div", "cart_item_elem");
					echo $item['artist'];
					gat("div");

					tag("div", "cart_item_elem");
					echo $item['price']."€";
					gat("div");

					tag("div", "cart_item_elem");
					echo $item['format'];
					gat("div");
				gat("div");
				gat("td");

				tag("td");
					tag("div", "cart_item_quantity");
					echo $item['quantity'];
					gat("div");
				gat("td");

				tag("td");
					tag("div", "cart_item_price");
					echo $item['total_price']."€";
					gat("div");
				gat("td");

				gat("div");
				gat("td");
			gat("tr");
		}
		tag("tr", "cart_last_row");
			echo "<td colspan=2 class=\"cart_last_row_start\">Prix Total : </td>";
			tag("td", "cart_total_price");
				$total_price = 0;
				foreach($cart_detail as $item)
				{
					$total_price += $item['total_price'];
				}
				echo $total_price."€";
			gat("td");
		gat("tr");
	gat("table");
	tag("div", "cart_final");

		tag("a", "cart_cancel", "./cart_cancel.php");
			tag("div", "cart_cancel_div");
				echo "Annuler la commande";
			gat("div");
		gat("a");

		tag("a", "cart_submit", "./cart_submit.php");
			tag("div", "cart_submit");
				echo "Valider la commande";
			gat("div");
		gat("a");

	gat("div");
	$_SESSION['cart_detail'] = $cart_detail;
}
gat("div");
?>
<?php 
mysqli_close($conn);
footer();
?>
