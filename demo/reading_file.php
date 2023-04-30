<?php

$file = "example.txt";

if($handle = fopen($file, 'r')) {
  echo $content = fread($handle, filesize($file)); // each bite equals a character
  fclose($handle); // close file
} else {
  echo "Error in writing into file";
}
