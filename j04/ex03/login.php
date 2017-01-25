<?PHP
session_start();
include("auth.php");
if (isset($_GET['login']) && isset($_GET['passwd']))
{
  if (auth($_GET['login'], $_GET['passwd']))
  {
    $_SESSION['loggued_on_user'] = $_GET["login"];
    echo "OK\n";
  }
  else
  {
    $_SESSION['loggued_on_user'] = "";
    echo "ERROR\n";
  }
}
else
{
  echo "ERROR\n";
}
?>
