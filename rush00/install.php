<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "musicstore";

function ft_split($str)
{
	return (preg_split("/;/", $str, 0, PREG_SPLIT_NO_EMPTY));
}

function merge($head, $tail)
{
	return (array_merge((array)$head, ft_split($tail)));
}

$conn = mysqli_connect($servername, $username, $password);

if (!$conn)
	die("Connection failed: " . mysqli_connect_error());
echo "Connected successfully\n";
mysqli_set_charset($conn, "utf8");

//create db
$sql = "CREATE DATABASE ".$dbname;
if (mysqli_query($conn, $sql)) {
	echo "Database created successfully";
} else {
	echo "Error creating database: " . mysqli_error($conn). "\n";
}

$sql = "USE musicstore";
if (mysqli_query($conn, $sql))
	echo "db selected\n";
else
	echo "Error selecting db: " . mysqli_error($conn). "\n";

//create product table
$sql = "CREATE TABLE products (
	product_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(255),
	artist VARCHAR(255),
	description VARCHAR(2048),
	img VARCHAR(255),
	stock INT UNSIGNED,
	price FLOAT,
	percent FLOAT,
	format VARCHAR(255)
)";
if (mysqli_query($conn, $sql))
	echo "Table products created successfully\n";
else
	echo "Error creating table: " . mysqli_error($conn). "\n";

//create genre table
$sql = "CREATE TABLE genre (
	genre_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	genre_name VARCHAR(255)
)";
if (mysqli_query($conn, $sql))
	echo "Table genre created successfully\n";
else
	echo "Error creating table: " . mysqli_error($conn). "\n";

//create cross table
$sql = "CREATE TABLE cross_table (
	product_id INT UNSIGNED,
	genre_id INT UNSIGNED
)";
if (mysqli_query($conn, $sql))
	echo "Table cross created successfully\n";
else
	echo "Error creating table: " . mysqli_error($conn). "\n";

//create carts table
$sql = "CREATE TABLE carts(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	user_id INT,
	user_name VARCHAR(255),
	cart_content VARCHAR(4242)
)";

if (mysqli_query($conn, $sql))
	echo "Table carts created successfully\n";
else
	echo "Error creating table: " . mysqli_error($conn). "\n";

//populate genre table
$arr_genre = [];
if (($fd = fopen("db/produits.csv", "r")) !== false)
{
	while (($data = fgetcsv($fd, 0, ',', '"')) !== false)
	{
		$data = array_map("trim", $data);
		$arr_genre[] = $data[9];
	}	
}
fclose($fd);
$arr_genre = array_unique(array_map("trim",array_reduce($arr_genre, "merge")));
$arr_genre = array_map("trim", $arr_genre);
foreach ($arr_genre as $genre)
{
	$genre = mysqli_real_escape_string($conn, $genre);
	$sql = "INSERT into genre (genre_name) values ('$genre')";
	mysqli_query($conn, $sql) or die(mysqli_error($conn));
}

$arr_genre = [];
$sql = "SELECT genre_id, genre_name FROM genre";
$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
if (mysqli_num_rows($res) > 0)
{
	while ($row = mysqli_fetch_assoc($res))
		$arr_genre[intval($row['genre_id'])] = $row['genre_name'];
}

//populate product and cross table
if (($fd = fopen("db/produits.csv", "r")) !== false)
{
	while (($data = fgetcsv($fd, 0, ',', '"')) !== false)
	{
		$data = array_map("trim", $data);
		foreach ($data as &$el)
			$el = mysqli_real_escape_string($conn, $el);
		$name = $data[1];
		$artist = $data[2];
		$description = $data[3];
		$img = $data[4];
		$stock = intval($data[5]);
		$price = floatval($data[6]);
		$percent = floatval($data[7]);
		$format = $data[8];
		$genre = $data[9];

		$sql = "INSERT into products (name, artist, description, img, stock, price, percent, format)
			values ('$name', '$artist', '$description', '$img', '$stock', '$price', '$percent', '$format')";
		mysqli_query($conn, $sql) or die(mysqli_error($conn));

		//get db id of current product
		$sql = "SELECT product_id from products WHERE name = '$name' and artist ='$artist' and description = '$description' and format = '$format'";
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
		$all_genre = ft_split($genre);
		foreach ($all_genre as $g)
		{
			$g = mysqli_real_escape_string($conn, $g);
			foreach ($arr_genre as $key => $value)
			{
				if ($value === $g)
				{
					$sql = "INSERT into cross_table (product_id, genre_id) values ('$current_id','$key')";
					mysqli_query($conn, $sql) or die(mysqli_error($conn));
				}
			}
		}
	}	
}
fclose($fd);

mysqli_close($conn);
?>
