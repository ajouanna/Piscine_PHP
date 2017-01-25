<?PHP
abstract class Fighter
{
	protected $_name = "Fighter";

	public function __construct($name)
	{
		$this->_name = $name;
	}

	abstract public function fight($target);
	public function getName()
	{
		return $this->_name;
	}
}
?>
