<?php
require_once("config.php");
require_once("addons.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(!isset($_SESSION['login'])){ //sprawdzanie czy zalogowany
  header("Location: ../index.php");
  die();
}
if(isset($_POST['pid']) && isset($_POST['name'])){
  $pid=$_POST['pid'];
  $pid = string_secure($pid);
  $dir_name=$_POST['name'];
  $dir_name = string_secure($dir_name);
}
else{
  header("Location: ../index.php"); //Blad:dane niekompletne
  die();
}
if($dir_name === ""){  //Blad:nazwa katalogu nie moze byc pusta
  header("Location: ../index.php");
  die();
}
$owner=$_SESSION['login'];
$date = date('Y-m-d H:i:s', time()); //aktualna data
if(mysqli_connect_errno()==0)
{
  $result = $connect->query("INSERT INTO files$dbprefix VALUES ('', '$pid', '$dir_name', '', '$owner', 'DIR', '$date', '', '')");
  $result = $connect->query("SELECT id FROM files$dbprefix WHERE pid='$pid' AND owner='$owner' AND name='$dir_name'");
  $row = $result->fetch_assoc();
  $id = $row['id'];
}
header("Location: filemanager.php?pid=$id");
die();
?>
