<?php
require_once("config.php");
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
$password=$_POST['password'];
$ver=$_POST['password2'];
$spambot=$_POST['spambot'];
$login=$_POST["login"];
$date=date('Y-m-d H:i:s', time());
if($password!=$ver){
	header("Location: registerform.php?err=1"); //blad: hasla nie zgadzaja sie
	die();
}
else if(strlen($password)<8){
	header("Location: registerform.php?err=2"); //blad:za krotkie haslo
	die();
}
else if($spambot!=10){
	header("Location: registerform.php?err=3"); //blad: zly spambot
	die();
}
else{
	if(mysqli_connect_errno()==0)
	{
    $result=$connect->query("SELECT * From users$dbprefix WHERE login='$login'");
    if(mysqli_num_rows($result) > 0 || $login=="Goœæ")
    {
	header("Location: registerform.php?err=4");  //blad: uzytkownik o tej nazwie juz istnieje
	die();
    }
    else{
        $passwd=sha1(sha1($password));
        $connect->query("INSERT INTO users$dbprefix VALUES ('', '$login', '$passwd', '1', '$date', '$default_storage', '0')");
        //przekierowanie do: dziekujemy za rejestracje a potem index.php
        die();
    }
  }
  else{
	echo "Brak po³¹czenia z baz¹";
	}
}
 ?>