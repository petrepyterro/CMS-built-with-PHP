<?php

$db['db_host']='localhost';
$db['db_user']='root';
$db['db_pass']='mysql';
$db['db_name']='cms';

foreach ($db as $key => $value){
  define(strtoupper($key), $value);
}


$connectiuon = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($connectiuon){
  echo "We are connected.";
}
