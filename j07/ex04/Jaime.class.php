<?PHP
class Jaime extends Lannister
{
	// cette classe accepte de coucher avec des classes de memes parents
	// (pas tres moral tout ca)
	public function sleepWith($arg) {
		if (get_parent_class($this) === get_parent_class($arg) && $arg->doYouAgree())
		{
			print("With pleasure, but only in a tower in Winterfell, then.".PHP_EOL);
			return;
		}
		parent::sleepWith($arg);
	}
}
?>
