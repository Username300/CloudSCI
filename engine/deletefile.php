<?php
function remdir($id,$connect,$dbprefix) { //przyjmuje id oraz dane polaczenia do sql
  if(mysqli_connect_errno()==0 && $id>0)
  {
      $result = $connect->query("SELECT id,type,path FROM files$dbprefix WHERE pid='$id'");
      while($row = $result->fetch_assoc()){
        $files[] = $row;
      }
      foreach ($files as $type){ //sprawdza czy jest w katalogu katalog
        if($type['type']==="DIR"){
          remdir($type['id'],$connect,$dbprefix); //jezeli jest katalog wejdzie do niego i ponownie sie wykona
        }
        else if($type['type']==="FILE"){ //jezeli obiekt jest plikiem to go usuwa
          $tmp = $type['id'];
          $path = $type['path'];
          $result = $connect->query("DELETE FROM files$dbprefix WHERE id='$tmp'");
          unlink($path);
        }
      }
      $result = $connect->query("DELETE FROM files$dbprefix WHERE id='$id'"); //pusty katalog jest usuwany
    unset($i);
  }
}

function refresh_usedspace($connect, $username, $dbprefix){
  $result = $connect->query("SELECT sum(size) AS size FROM files$dbprefix WHERE owner='$username';");
  $row = $result->fetch_assoc();
  $size = intval($row['size']);
  $result = $connect->query("UPDATE users$dbprefix SET usedspace=$size WHERE login='$username';");
}

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
    $result = $connect->query("SELECT path,type FROM files$dbprefix WHERE id='$id'"); //pobieranie metadanych obiketu
    $row = $result->fetch_assoc();
    $path = $row['path']; //sciezka do usuwanego pliku
    $type = $row['type']; //plik czy katalog
    if($type === "DIR"){
      remdir($id,$connect,$dbprefix);
      refresh_usedspace($connect, $owner, $dbprefix);
      header("Location: filemanager.php");
      die();
    }
    else if($type === "FILE"){
      unlink($path);
      $result = $connect->query("DELETE FROM files$dbprefix WHERE id='$id'"); //usuwanie wpisu pliku
      refresh_usedspace($connect, $owner, $dbprefix);
      header("Location: filemanager.php?pid=$pid");
      die();
    }
  }
}
else{
    header("Location: ../index.php");
    die();
}
