<?php
include 'SetToDevMode.php';

if ($_GET["cfsecr"] == getenv('cfsecr')){
  if ($_GET["zone"]){
    devmode($_GET["zone"]); 
  }
} else {
  echo "Hello World!";
}

?>