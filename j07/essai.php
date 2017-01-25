<?PHP
class A {
	public $attr = 42;
	function __construct()
	{
		print("Constructeur de ".__CLASS__."\n");
	}

	function foo()
	{
		Print("a::foo()\n");
	}
}

class B extends A {
	function __construct()
	{
		print("Constructeur de ".__CLASS__."\n");
		parent::__construct();
		print("Valeur de attr = $this->attr\n"); 
		$this->foo();
	}
	function foo()
	{
		parent::foo();
		Print("b::foo()\n");
	}
}

$b = new B;

?>
