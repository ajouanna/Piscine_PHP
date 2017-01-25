<?PHP
// require_once 'Lannister.class.php';

class Tyrion extends Lannister {
	// cette sous classe implemente le comportement par defaut
	// sauf pour doYouAgree : refus de coucher si on me demande
public function doYouAgree()
	{
		return false;
	}
}
?>

