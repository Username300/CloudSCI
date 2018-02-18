<?php
require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0){
  if(isset($_GET['id']) && isset($_GET['pid']) && isset($_GET['action']) && isset($_SESSION['login'])){
    $id=intval($_GET['id']);
    if($id<1){
      header("Location: filemanager.php");
      die();
    }
    $pid=intval($_GET['pid']);
    $action=intval($_GET['action']);
    $owner=$_SESSION['login'];
    unset($_SESSION['move']);
    if($action==0){
      header("Location: filemanager.php?pid=$pid");
      die();
    }
    else if($action==1){ //kopiowanie to do
      //$result = $connect->query("SELECT size FROM files$dbprefix WHERE id='$id' AND owner='$owner' ");
      //$row = $result->fetch_assoc();
      //$size = $row['size'];
      header("Location: filemanager.php?pid=$pid");
      die();
    }
    else if($action==2){
      $result = $connect->query("UPDATE files$dbprefix SET pid='$pid' WHERE id='$id' AND owner='$owner' AND type='FILE' ");
      header("Location: filemanager.php?pid=$pid");
      die();
    }
    else{
      header("Location: filemanager.php?pid=$pid");
      die();
    }
  }

  else{
    header("Location: ../index.php");
    die();
  }

}
else{
  header("Location: ../index.php");
  die();
}
?>
