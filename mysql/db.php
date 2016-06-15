<?php

$connection = mysqli_connect('localhost', 'root', 'mysql', 'cms');

if (!$connection){
  die("database connection failed");
}
