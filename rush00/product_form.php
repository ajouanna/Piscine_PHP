<?php
include("./header.php");
include("./footer.php");

function print_genre_checkboxes($g_id, $all_genre)
{
	foreach($all_genre as $genre)
	{
		echo "<input type=\"checkbox\" name=\"genre[]\" value=\"$genre\"";
		if (in_array($genre, $g_id))
			echo " checked=\"checked\"";
		echo ">$genre</input><br/>\n";
	}
}

$id = $_GET['id'];
$i = null;
if ($id)
{
	$sql = "SELECT * FROM products WHERE product_id=$id";
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if (mysqli_num_rows($res) > 0)
		$i = mysqli_fetch_assoc($res);
}
?>
<div class="admin_product_form">

<form action="
<?php
echo "./product_modify.php";
if ($id)
	echo "?id=$id";
?>
" method="post">

	<label>Nom :</label><input name="name" value="<?php echo $i['name']?>" />
	<br/>
	<label>Artist :</label><input name="artist" value="<?php echo $i['artist']?>" />
	<br/>
	<label>Lien image :</label><input name="img" value="<?php echo $i['img']?>" />
	<br/>
	<label>Prix :</label><input name="price" value="<?php echo $i['price']?>" />
	<br/>
	<label>Format :</label><input name="format" value="<?php echo $i['format']?>" />
	<br/>
	<label>Description :</label><input name="description" size="50" value="<?php echo $i['description']?>" />
	<br/>
<?php
$g_id = [];
if ($id)
{
	$sql = "SELECT genre_name FROM genre WHERE genre_id IN (SELECT genre_id FROM cross_table WHERE product_id=$id)";
	$db_genre = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	if (mysqli_num_rows($db_genre) > 0)
	{
		while ($genre_row = mysqli_fetch_assoc($db_genre))
			$g_id[] = $genre_row['genre_name'];
	}
}

$sql = "SELECT genre_name FROM genre";
$db_genre = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$all_genre= [];
if (mysqli_num_rows($db_genre) > 0)
{
	while ($genre_row = mysqli_fetch_assoc($db_genre))
		$all_genre[] = $genre_row['genre_name'];
}

print_genre_checkboxes($g_id, $all_genre);
?>
<input type="submit" value="OK"/>
</form>
</div>
<?php 
mysqli_close($conn);
footer();
?>
