<?php
require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['id']) && isset($_SESSION['login']))
  {
    if(isset($_POST['pid'])) {
      $pid=$_POST['pid'];
      settype($pid, "integer");
    }
    $owner = $_SESSION['login'];
    $id=$_POST['id'];
    settype($id, "integer");
    $result = $connect->query("SELECT usedspace FROM users$dbprefix WHERE login='$owner'"); //okreslanie przestrzeni dyskowej
    $row = $result->fetch_assoc();
    $used_space = $row['usedspace'];
    $result = $connect->query("SELECT size,path,type FROM files$dbprefix WHERE id='$id'"); //okreslanie rozmiaru pliku lub katalogu
    $row = $result->fetch_assoc();
    $file_size = $row['size'];
    var_dump($row);
    $updated_space = $used_space - $file_size;
    $path = $row['path']; //sciezka do usuwanego pliku
    $type = $row['type']; //plik czy katalog
    if($type === "DIR"){
      $result = $connect->query("DELETE FROM files$dbprefix WHERE pid='$id'");
      $result = $connect->query("DELETE FROM files$dbprefix WHERE id='$id'");
      header("Location: filemanager.php");
      die();
    }
    else if($type === "FILE"){
      unlink($path);
      $result = $connect->query("DELETE FROM files$dbprefix WHERE id='$id'"); //usuwanie wpisu pliku
      $result = $connect->query("UPDATE users$dbprefix SET usedspace = '$updated_space' WHERE login = '$owner'");
      header("Location: filemanager.php?pid=$pid");
      die();
    }
  }
}
else{
    header("Location: ../index.php");
    die();
}
