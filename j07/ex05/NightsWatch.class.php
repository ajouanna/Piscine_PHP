<?PHP
class NightsWatch
{
	private $_fighters; //conserve la liste des fighters

	public function recruit($fighter)
	{
		// ne prendre que les fighters
		$interf = class_implements($fighter);
		if (array_key_exists('IFighter', $interf)) // j'aurais pu utiliser isset
		{
			$this->_fighters[] = $fighter;	
		}
		// nb: on peut aussi utiliser : if ($fighter instanceof IFighter)
	}	
	public function fight()
	{
		foreach ($this->_fighters as $key => $value) {
			$value->fight();
		}

	}
}
?>

