<?PHP
require_once 'Vector.class.php';

class Matrix {
	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE preset"; 
	const RX = "Ox ROTATION preset";
	const RY = "Oy ROTATION preset";
	const RZ = "Oz ROTATION preset";
	const TRANSLATION = "TRANSLATION preset";
	const PROJECTION = "PROJECTION preset";

	private $_matrix = array(array(1, 0, 0, 0), array(0, 1, 0, 0), array(0, 0, 1, 0), array(0, 0, 0, 1) );

	static $verbose = False;

	private static $_className = "Matrix";


	static function doc()
	{
		$filename = self::$_className.".doc.txt";
		if (file_exists($filename))
		{
			$str = file_get_contents($filename);
		}
		else
		{
			$str = "Documentation inexistente";
		}

		return ($str);
	}

	public function __construct( array $kwargs ) {
		if ( !array_key_exists('preset', $kwargs ) )
			return;
		if ( self::$verbose == TRUE )
			print('Matrix ' . $kwargs['preset'] . ' instance constructed' . PHP_EOL);	
		// A POURSUIVRE

	}

	public function __destruct() {
		if ( self::$verbose == TRUE )
			print('Matrix instance destructed' . PHP_EOL);
		return;
	}

	public function __toString() {
		return (sprintf('M | vtcX | vtcY | vtcZ | vtxO' . PHP_EOL . '-----------------------------' . PHP_EOL . 'x | %.2f | %.2f | %.2f | %.2f' . PHP_EOL . 'y | %.2f | %.2f | %.2f | %.2f' . PHP_EOL . 'z | %.2f | %.2f | %.2f | %.2f' . PHP_EOL . 'w | %.2f | %.2f | %.2f | %.2f', $this->_matrix[0][0], $this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3], $this->_matrix[1][0], $this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3], $this->_matrix[2][0], $this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3], $this->_matrix[3][0], $this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3] ) );
	}
}
?>

