<?php

ini_set('default_charset', 'UTF-8');

$locale  = isset($_GET['locale']) ? $_GET['locale'] : 'no';

$boys = csv_to_array("locale/$locale/boys.csv");
$girls = csv_to_array("locale/$locale/girls.csv");
$surnames = csv_to_array("locale/$locale/surnames.csv");

$locale  = isset($_GET['locale']) ? $_GET['locale'] : 'no';

$tables = '';

$lists=explode(",",$_GET['lists']);

foreach($lists as $list) {
  list($name,$count) = explode("|",$list); 
  $tables .= build($name,$count, $boys, $girls, $surnames);
  $tables .= "<br /><br />";
}

require 'templates/tables.html';

exit;


function build($name, $count, $boys, $girls, $surnames) {

  $table  = '<table style="border: 1px solid lightgray;">';
  $table .= '<tr><th>'.$name.' ('.$count.')</th></tr>';


  for($i=0;$i<$count;$i++) {
    $table .= '<tr><td style="border-top: 1px solid lightgray;">';
    if(rand(0, 1) === 1) {
       $table .= $boys[rand(0,count($boys)-1)];
    } else {
      $table .= $girls[rand(0,count($girls)-1)];
    }
    $table .= " " . $surnames[rand(0,count($surnames)-1)] . "</td></tr>";
  }

  return $table . "</table";

}


function csv_to_array($file) {
  $rows = array();
  if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $rows[] = $data[0];
    }
    fclose($handle);
  }
  return $rows;
}


?>
