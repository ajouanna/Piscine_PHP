<?php

class Lannister {

	// si on me demande si je veux coucher, je dis oui
	public function doYouAgree()
	{
		return true;
	}

	// le comportement par defaut est de refuser de coucher avec une classe 
	// issue de la meme mere et d'accepter sinon
	public function sleepWith($arg) {
		if (get_parent_class($this) === get_parent_class($arg))
		{
			print("Not even if I'm drunk !".PHP_EOL);
			return;
		}
		else
		{
			print("Let's do this.".PHP_EOL);
		}
	}
}
?>
