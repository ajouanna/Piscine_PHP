<?PHP
require_once 'Color.class.php';

class Vertex {
	static $verbose = False;
	private $_x; 
	private $_y; 
	private $_z; 
	private $_w = 1.0; 
	private $_color;
	private static $_className = "Vertex";

	public function getX()
	{
		return $this->_x;
	}
	public function getY()
	{
		return $this->_y;
	}
	public function getZ()
	{
		return $this->_z;
	}
	public function getW()
	{
		return $this->_w;
	}
	public function getColor()
	{
		return $this->_color;
	}

	public function setX($param)
	{
		$this->_x = $param;
	}
	public function setY($param)
	{
		$this->_y = $param;
	}
	public function setZ($param)
	{
		$this->_z = $param;
	}
	public function setW($param)
	{
		$this->_w = $param;
	}
	public function setColor($param)
	{
		$this->_color = $param;
	}

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

	function __tostring() {
		// mettre x, y, z, w et color
		$str=self::$_className.sprintf("( x: %.2f", $this->getX()).sprintf(", y: %.2f",$this->getY());
		$str .= sprintf(", z:%.2f",$this->getZ()).sprintf(", w:%.2f",$this->getW());
		if (self::$verbose === True)
		{
			$str .=", ".$this->getColor()." )";
		
		}
		else
		{
			$str .= " )";
		}
		return $str;
	}

	function __construct(array $kwa) {
		if (array_key_exists('x', $kwa) &&
				array_key_exists('y', $kwa) &&
				array_key_exists('z', $kwa))
		{ 
			$this->setX($kwa['x']);
			$this->setY($kwa['y']);
			$this->setZ($kwa['z']);
			if (array_key_exists('w', $kwa))
				$this->setW($kwa['w']);
		} 
		if (array_key_exists('color', $kwa)) 
		{ 
			$this->setColor($kwa['color']); 
		} 
		else
		{
			$white = new Color( array( 'red' => 255, 'green' => 255, 'blue' => 255 ) );
			$this->setColor($white); 
		}
		if (self::$verbose === True)
		{
			print($this." constructed\n");
		}

		return;
	}
	function __destruct() {
		if (self::$verbose === True)
		{
			print($this." destructed\n");
		}
		return;
	}
}
?>

