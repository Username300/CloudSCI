//Nie kopiowac do /engine
//***TO NIE DZIALA***




<?php
require_once("config.php");
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
$password=$_POST['password'];
$ver=$_POST['password2'];
$spambot=$_POST['spambot'];
$login=$_POST["login"];
$date=date('Y-m-d H:i:s', time());
if($password!=$ver){
	//blad:zle przepisane haslo
	echo "hasla sie nie zgadzajo";
	//die();
}
else if(strlen($password)<8){
	//blad:za krotkie haslo
	echo "krotkie haslo";
	//die();
}
else if($spambot!=10){
	//blad: zly spambot
	echo "spambot";
	//die();
}
else{
	if(mysqli_connect_errno()==0)
	{
    $result=$connect->query("SELECT * From users'$dbprefix' WHERE username='$login'");
    if($result->num_rows > 0 || $login=="Gość")
    {
        echo xd;
        die();
    }
    else{
        $passwd=sha1(sha1($password)); //podwojne hashowanie hasla
        $connect->query("INSERT INTO users'$dbprefix' VALUES ('', '$login', '$passwd', '1', '$date', '$default_storage', '0')");
				var_dump($login);
				var_dump($password);
				var_dump($passwd);
				var_dump($date);
				var_dump($default_storage);
				var_dump($dbprefix);
				var_dump($result);
				var_dump($connect);
        //przekierowanie do: dziekujemy za rejestracje a potem index.php
        //die();
    }
  }
  else{
		echo "Brak połączenia z bazą";
	}
}
 ?>
