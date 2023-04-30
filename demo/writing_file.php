<?php

$file = "example.txt";

if($handle = fopen($file, 'w')) {
  fwrite($handle, 'Hello');
  fclose($handle); // close file
} else {
  echo "Error in writing into file";
}


?>