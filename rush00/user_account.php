<?php
include("./header.php");
include("./footer.php");
include("./html.php");

tag("div", "user_account");

tag("div", "user_modif");
tag("h4");
echo "Changement du mot de passe";
gat("h4");
echo "<form action=\"./user_modif.php\" method=\"post\">\n";
echo "<label>Ancien mot de passe: </label><input name=\"oldpw\" type=\"password\"/>\n";
echo "	<br />\n";
echo "<label>Nouveau mot de passe: </label><input name=\"newpw\" type=\"password\"/>\n";
echo "	<br />\n";
echo "<label>Confirmez: </label><input name=\"repw\" type=\"password\"/>\n";
echo "	<input type=\"submit\" name=\"submit\" value=\"OK\"/>\n";
echo "</form>\n";
gat("div");

if ($_SESSION['profil'] != 'admin')
{
	tag("div", "user_delete");
	tag("h4");
	echo "Suppression de compte";
	gat("h4");
	echo "<form action=\"./user_delete.php\" method=\"post\">\n";
	echo "<label>Mot de passe: </label><input name=\"passwd\" type=\"password\"/>\n";
	echo "	<input type=\"submit\" name=\"submit\" value=\"Supprimer mon compte\"/>\n";
	echo "</form>\n";
	gat("div");
}

gat("div");

mysqli_close($conn);
footer();
?>
