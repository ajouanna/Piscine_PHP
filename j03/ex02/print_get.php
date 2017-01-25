<?php
	// affichage des parametres passes dans l'url : ils sont
	// dans l array _GET
	foreach ($_GET as $key => $value)
	{
		echo $key.": ".$value."\n"; // en HTML, il faudrait mettre la balise br
	}
?>
