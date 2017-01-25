<?php
if (!isset($_SERVER['PHP_AUTH_USER']))
{
    header("WWW-Authenticate: Basic realm=''Espace membres'");
    header('HTTP/1.0 401 Unauthorized');
}
else
{
	if ($_SERVER['PHP_AUTH_USER'] == "zaz" && $_SERVER['PHP_AUTH_PW'] == "jaimelespetitsponeys")
	{
		?>
<html><body>
Bonjour Zaz<br />
<?php
$image = "../img/42.png";
// convertir l'image a l encodage base64
$imageData = base64_encode(file_get_contents($image));

// Format de l image :  data:{mime};base64,{data};
$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

// affichage de l'image
echo '<img src="', $src, '">';
?>
</body></html>
<?php
	}
	else
	{
		header("WWW-Authenticate: Basic realm=''Espace membres''");
	    header('HTTP/1.0 401 Unauthorized');
?>
<html><body>Cette zone est accessible uniquement aux membres du site</body></html>
<?php
  }
}
?>
