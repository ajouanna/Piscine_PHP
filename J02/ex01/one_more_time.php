#!/usr/bin/php
<?php
if ($argc == 2)
{
  $les_mois=array("Janvier" => 1, "Fevrier" => 2, "Mars" => 3, "Avril" => 4, "Mai" => 5,
                  "Juin" => 6, "Juillet", 7, "Aout" => 8, "Septembre" => 9, "Octobre" => 10,
                  "Novembre" => 11, "Decembre"=>12);
  $les_jours=array("Lundi" => 1, "Mardi" => 2, "Mercredi" => 3, "Jeudi" => 4,
                "Vendredi" => 5, "Samedi" => 6, "Dimanche" => 7);
  // convertir les elements dans argc[1]
  // "Mardi 12 Novembre 2013 12:02:21"
  $tab = explode(" ", $argv[1]);
  // print_r($tab);
  list($jour, $journum, $mois, $annee, $heuremns) = $tab;

  // verifier le jour de la semaine
  $jour_semaine=$les_jours[$jour];
  if ($jour_semaine == false)
  {
    echo "Wrong Format\n";
    exit;
  }
  // verifier le jour
  $nb = preg_match("/[0-9]{1,2}/", $journum, $match);
  if ($nb === 1)
  {
    // echo "DEBUG: format jour num correct\n";
  }
  else
  {
    echo "Wrong Format\n";
    exit;
  }
  // verifier le jour de la semaine
  $mois_num = $les_mois[$mois];
  if ($mois_num == false)
  {
    echo "Wrong Format\n";
    exit;
  }

  // verifier l'annee
  $nb = preg_match("/[0-9]{4}/", $annee, $match);
  if ($nb === 1)
  {
    // echo "DEBUG: format annee correct\n";
  }
  else
  {
    echo "Wrong Format\n";
    exit;
  }

  // verifier l heure
  if (preg_match('#^([0-2][0-9]):([0-5][0-9]):([0-5][0-9])$#', $heuremns,$hhmmss) == 1)
  {
    // echo "DEBUG: format HH:MM:SS correct\n";
    // print_r($hhmmss);
  }
  else
  {
    echo "Wrong Format\n";
    exit;
  }

  // appeler mktime
  if ($unixtime = mktime($hhmmss[1], $hhmmss[2], $hhmmss[3], $mois_num, $journum, $annee, 1))
    echo "$unixtime\n";
  else
    echo "Wrong Format\n";
}
?>
