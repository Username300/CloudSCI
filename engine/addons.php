<?php
//Zawiera dodatkowy zestaw funkcji uzywanych globalnie

function secure_string($connect, $string){
  $string = $connect->real_escape_string($string);
  $string = htmlspecialchars($string);
  return $string;
}


 ?>
