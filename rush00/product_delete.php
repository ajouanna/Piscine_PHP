<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "musicstore";

session_start();
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn)
	die("Connection failed: " . mysqli_connect_error());
mysqli_set_charset($conn, "utf8");
$product_id = $_GET['id'];

if (isset($_SESSION['profil']) && $_SESSION['profil'] === "admin" )
{
	$sql = "DELETE from products WHERE product_id=$product_id";
	mysqli_query($conn, $sql) or die(mysqli_error($conn));
}
header("Location: ./admin.php");
?>
