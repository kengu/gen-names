<?php

$locale  = isset($_GET['locale']) ? $_GET['locale'] : 'no';


$boys = csv_to_array("locale/$locale/boys.csv");
$girls = csv_to_array("locale/$locale/girls.csv");
$surnames = csv_to_array("locale/$locale/surnames.csv");

$locale  = isset($_GET['locale']) ? $_GET['locale'] : 'no';


$lists=explode(",",$_GET['lists']);

foreach($lists as $list) {
  list($name,$count) = explode("|",$list); 
  print_l($name,$count, $boys, $girls, $surnames);
  echo "<br /><br />";
}

function print_l($name, $count, $boys, $girls, $surnames) {

  echo '<table style="border: 1px solid lightgray;">';
  echo '<tr><th>'.utf8_decode($name).' ('.$count.')</th></tr>';


  for($i=0;$i<$count;$i++) {
    echo '<tr><td style="border-top: 1px solid lightgray;">';
    if(rand(0, 1) === 1) {
       echo $boys[rand(0,count($boys)-1)];
    } else {
      echo $girls[rand(0,count($girls)-1)];
    }
    echo " " . $surnames[rand(0,count($surnames)-1)];
    echo "</td></tr>";
  }

  echo "</table";

}


function csv_to_array($file) {
  $rows = array();
  if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $rows[] = utf8_decode($data[0]);
    }
    fclose($handle);
  }
  return $rows;
}


?>
