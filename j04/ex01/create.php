<?php
// session_start(); // pas de session dans cet exercice
function print_error()
{
  echo "ERROR\n";
  exit;
}
// tester si les parametres login et passwd sont bien presents
if (!isset($_POST["login"]) || !isset($_POST["passwd"]))
  print_error();

// tester si leur vqleur n'est pas nulle
if (!$_POST["login"] || !$_POST["passwd"])
  print_error();

if (isset($_POST['submit']) && $_POST['submit'] == "OK")
{
  $dir="../private";
  $filename=$dir."/passwd";
  $new_elem["login"]=$_POST["login"];
  $new_elem["passwd"]=hash("whirlpool",$_POST["passwd"]);
  $tabsecurite[]=$new_elem;
  if (!file_exists($dir))
  {
    mkdir($dir);
  }
  if (!file_exists($filename))
  {
    $str=serialize($tabsecurite);
    file_put_contents($filename,$str);
    echo "OK\n";
  }
  else
  {
    $tabsecurite=unserialize(file_get_contents($filename));
    foreach ($tabsecurite as $element)
    {
      // si ce login existe deja, faire une erreur
      if ($element['login'] === $_POST['login'])
      {
        print_error(); // on s arrete ici
      }
    }
    $tabsecurite[]=$new_elem;
    $str=serialize($tabsecurite);
    file_put_contents($filename,$str);
    echo "OK\n";
  }

}
else
{
  print_error();
}
?>
