<?php
//Zawiera dodatkowy zestaw funkcji uzywanych globalnie

function string_secure($input){ //zabezpiecza wprowadzane dane przed atakami
  $temp = trim($input);
  $temp = stripslashes($temp);
  $output = htmlspecialchars($temp);
  return $output;
}



 ?>
