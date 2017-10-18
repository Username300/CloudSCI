<?php
require_once("config.php");
session_start();
$login=$_POST["login"];
$password=$_POST["password"];
$password=sha1(sha1($password));
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  $result=$connect->query("SELECT * From users$dbprefix WHERE login='$login' AND password='$password'");
  if(mysqli_num_rows($result) > 0){
    $row=$result->fetch_assoc();
    $_SESSION['login']=$login;
    $_SESSION['permissions']=$row['permissions'];
    $_SESSION['storage']=$row['storage'];
    $_SESSION['usedspace']=$row['usedspace'];
    header("Location: filemanager.php");
		die();
  }
  else{
    session_unset();
    session_destroy();
    header("Location: loginform.php?err=1");
    die();
  }
}

?>
