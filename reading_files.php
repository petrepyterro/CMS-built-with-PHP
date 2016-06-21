<?php

$file = "example.txt";

if ($handle = fopen($file, "r")){
  //echo $content = fread($handle, 10); //each byte equals a character
  echo $content = fread($handle, filesize($file)); //read the whole file
  
  fclose($handle);
} else {
  echo "The application was not able to write on the file";
};

