<?PHP
require_once 'Vertex.class.php';

class Vector {
	static $verbose = False;
	private $_x; 
	private $_y; 
	private $_z; 
	private $_w = 0.0; 
	private static $_className = "Vector";

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
		// mettre x, y, z, w 
		$str=self::$_className;
		$str .= sprintf("( x:%.2f", $this->getX()).sprintf(", y:%.2f",$this->getY());
		$str .= sprintf(", z:%.2f",$this->getZ()).sprintf(", w:%.2f",$this->getW());
		$str .= " )";
		return $str;
	}

	function __construct(array $kwa) {
		if (array_key_exists('dest', $kwa))
		{ 
			$dest = $kwa['dest']; 
			if (array_key_exists('orig', $kwa)) 
			{ 
				$orig = $kwa['orig']; 
			} 
			else
			{
				$orig = new Vertex( array( 'x' => 0, 'y' => 0, 'z' => 0 , 'w' => 1) );
			}
			$this->_x = $dest->getX() - $orig->getX();
			$this->_y = $dest->getY() - $orig->getY();
			$this->_z = $dest->getZ() - $orig->getZ();
			$this->_w = $dest->getW() - $orig->getW();
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

	public function magnitude()
	{
		return (sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z));
	}

	public function normalize()
	{
		$mag = $this->magnitude();
		$vert = new Vertex(array('x' => $this->_x/$mag, 'y' => $this->_y/$mag, 'z' => $this->_z/$mag));
		$new = new Vector(array('dest' => $vert));
		return($new);
	}

	public function add(Vector $rhs)
	{
		$vert = new Vertex(array('x' => $this->_x + $rhs->getX(), 'y' => $this->_y + $rhs->getY(), 'z' => $this->_z + $rhs->getZ()));
		$new = new Vector(array('dest' => $vert));
		return($new);
	}

	public function sub(Vector $rhs)
	{
		$vert = new Vertex(array('x' => $this->_x - $rhs->getX(), 'y' => $this->_y - $rhs->getY(), 'z' => $this->_z - $rhs->getZ()));
		$new = new Vector(array('dest' => $vert));
		return($new);
	}

	public function opposite()
	{
		$vert = new Vertex(array('x' => -$this->_x, 'y' => -$this->_y, 'z' => -$this->_z));
		$new = new Vector(array('dest' => $vert));
		return($new);
	}

	public function scalarProduct($k)
	{
		$vert = new Vertex(array('x' => $k * $this->_x, 'y' => $k * $this->_y, 'z' => $k * $this->_z));
		$new = new Vector(array('dest' => $vert));
		return($new);
	}

	public function dotProduct(Vector $rhs)
	{
		$x = $this->_x * $rhs->getX();
		$y = $this->_y * $rhs->getY();
		$z = $this->_z * $rhs->getZ();
		return($x + $y + $z);
	}
	public function cos(Vector $rhs)
	{
		$cos = ($this->dotProduct($rhs)/($this->magnitude() * $rhs->magnitude()));
		return ($cos);	
	}
	public function crossProduct(Vector $rhs)
	{
		$vert = new Vertex(array('x' => $this->_y * $rhs->getZ() - $this->_z *$rhs->getY(),
								'y' => $this->_z * $rhs->getX() - $this->_x *$rhs->getZ(), 
								'z' => $this->_x * $rhs->getY() - $this->_y *$rhs->getX()));
		$new = new Vector(array('dest' => $vert));
		return($new);
	}
}
?>

