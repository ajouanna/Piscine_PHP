<?php
session_start();

function update_cross_table($conn, $all_genre, $selected_genre_name, $product_id)
{
	$selected_genre_id = [];
	foreach ($all_genre as $g_id => $g_name)
	{
		if (in_array($g_name, $selected_genre_name))
			$selected_genre_id[] = $g_id;
	}
	$sql = "DELETE FROM cross_table WHERE product_id=$product_id";
	mysqli_query($conn, $sql) or die(mysqli_error($conn));
	foreach ($selected_genre_id as $s_id)
	{
		$sql = "INSERT INTO cross_table (product_id, genre_id) values ('$product_id', '$s_id')";
		mysqli_query($conn, $sql) or die(mysqli_error($conn));
	}
}

if (isset($_SESSION['profil']) && $_SESSION['profil'] == "admin")
{
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "musicstore";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn)
		die("Connection failed: " . mysqli_connect_error());
	mysqli_set_charset($conn, "utf8");
	foreach ($_POST as &$el)
	{
		if (is_string($el))
			$el = mysqli_real_escape_string($conn, $el);
	}
	$name = $_POST['name'];
	$artist = $_POST['artist'];
	$img = $_POST['img'];
	$price = $_POST['price'];
	$format= $_POST['format'];
	$description = $_POST['description'];
	$sql = "SELECT genre_id,genre_name FROM genre";
	$db_genre = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$all_genre = [];
	if (mysqli_num_rows($db_genre) > 0)
	{
		while ($genre_row = mysqli_fetch_assoc($db_genre))
			$all_genre[$genre_row['genre_id']] = $genre_row['genre_name'];
	}
	if (isset($_GET['id']))
	{
		$id = $_GET['id'];
		$sql = "UPDATE products
			SET name='$name', artist='$artist', description='$description', img='$img', price='$price', format='$format'
			WHERE product_id=$id";
		mysqli_query($conn, $sql) or die(mysqli_error($conn));
		update_cross_table($conn, $all_genre, $_POST['genre'], $id);
	}
	else
	{
		$sql = "INSERT into products (name, artist, description, img, price, format)
			values ('$name', '$artist', '$description', '$img', '$price', '$format')";
		mysqli_query($conn, $sql) or die(mysqli_error($conn));

		//get db id of current product
		$sql = "SELECT product_id from products WHERE name = '$name' and artist ='$artist' and img='$img' and description = '$description' and format = '$format'";
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		if (mysqli_num_rows($res) != 1)
		{
			echo "error\n";
		}
		else
		{
			$row = mysqli_fetch_assoc($res);
			$current_id = $row['product_id'];
		}

		//populate cross array
		foreach ($all_genre as $g_key => $g)
		{
			$g = mysqli_real_escape_string($conn, $g);
			foreach ($_POST['genre'] as $key => $value)
			{
				if ($value === $g)
				{
					$sql = "INSERT into cross_table (product_id, genre_id) values ('$current_id','$g_key')";
					mysqli_query($conn, $sql) or die(mysqli_error($conn));
				}
			}
		}
	}
}
header("Location: ./admin.php");

?>
