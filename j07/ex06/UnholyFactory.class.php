<?PHP
class UnholyFactory
{
	private $_soldiers;

	public function __construct()
	{
		$this->_soldiers = array(); // cette initialisation semble necessaire pour eviter un warning dans absorb
	}

	public function absorb($soldier)
	{
		if ($soldier instanceof Fighter)
		{
			foreach ($this->_soldiers as $fighter) {
				if ($fighter->getName() === $soldier->getName())
				{
					print(("(Factory already absorbed a fighter of type ".$soldier->getName().")".PHP_EOL));
					return;
				}

			}
			$this->_soldiers[] = $soldier;
			print ("(Factory absorbed a fighter of type ".$soldier->getName().")".PHP_EOL);
		}
		else
		{
			print ("(Factory can't absorb this, it's not a fighter".")".PHP_EOL);
		}
	}
	public function fabricate($fighter_name)
	{
		$found = false;
		foreach ($this->_soldiers as $soldier) {
			if ($soldier->getName() === $fighter_name)
			{
				print ("(Factory fabricates a fighter of type ".$soldier->getName().")".PHP_EOL);
				$found = true;
				break;
			}

		}
		if ($found)
			return $soldier;
		else 
			print("(Factory hasn't absorbed any fighter of type ".$fighter_name.")".PHP_EOL);
		return null;
	}
}
?>
