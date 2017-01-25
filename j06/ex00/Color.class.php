<?PHP
class Color {
	static $verbose = False;
	public $red = 0; 
	public $green = 0; 
	public $blue = 0; 

	private static $_className = "Color";
	private function _internalToString() {
		$str=self::$_className.sprintf("( red: %3d", $this->red).sprintf(", green: %3d",$this->green).sprintf(", blue: %3d",$this->blue)." )";
		return $str;
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
		$str=self::$_className.sprintf("( red: %3d", $this->red).sprintf(", green: %3d",$this->green).sprintf(", blue: %3d",$this->blue)." )";
		return $str;
		//		return $this._internalToString();
	}

	function __construct(array $kwa) {
		if (array_key_exists('rgb', $kwa)) 
		{ 
			$rgb = intval($kwa['rgb']);
			$this->red = ($rgb >> 16) & 255;
			$this->green = ($rgb >> 8) & 255;
			$this->blue = $rgb & 255;
		} else if (array_key_exists('red', $kwa) &&
				array_key_exists('green', $kwa) &&
				array_key_exists('blue', $kwa))
		{ 
			$this->red = intval($kwa['red']); 
			$this->green = intval($kwa['green']); 
			$this->blue = intval($kwa['blue']); 
		} 
		// verifications des valeurs
		if ($this->red < 0)
			$this->red = 0;
		if ($this->green < 0)
			$this->green = 0;
		if ($this->blue < 0)
			$this->blue = 0;
		if ($this->red > 255)
			$this->red = 255;
		if ($this->green > 255)
			$this->green = 255;
		if ($this->blue > 255)
			$this->blue = 255;
		if (self::$verbose === True)
		{
			$out=$this->_internalTostring();
			$out .= " constructed.\n";
			print($out);
		}

		return;
	}
	function __destruct() {
		if (self::$verbose === True)
		{
			$out=$this->_internalTostring();
			$out .= " destructed.\n";
			print($out);
		}
		return;
	}

	function add(Color $inst) {
		$new= new Color( array('red' => $this->red + $inst->red, 
			'green' => $this->green + $inst->green, 
			'blue' => $this->blue + $inst->blue));
		return $new;
	}

	function sub(Color $inst) {
		$new= new Color( array('red' => $this->red - $inst->red, 
			'green' => $this->green - $inst->green, 
			'blue' => $this->blue - $inst->blue));
		return $new;
	}

	function mult($factor) {
		$new= new Color( array('red' => $this->red * $factor, 
			'green' => $this->green * $factor, 
			'blue' => $this->blue * $factor));
		return $new;
	}
}
?>

