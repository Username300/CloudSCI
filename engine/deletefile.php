<?php
require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['id']) && isset($_SESSION['login']))
  {
    $owner = $_SESSION['login'];
    $id=$_POST['id'];
    $result = $connect->query("SELECT usedspace FROM users$dbprefix WHERE login='$owner'"); //okreslanie przestrzeni dyskowej
    $row = $result->fetch_assoc();
    $used_space = $row['usedspace'];
    $result = $connect->query("SELECT 'size','path' FROM files$dbprefix WHERE id='$id'"); //okreslanie rozmiaru pliku
    $row = $result->fetch_assoc();
    $file_size = $row['size'];
    $updated_space = $used_space - $file_size;
    $path = $row['path']; //sciezka do usuwanego pliku
    unlink($path);
    $result = $connect->query("DELETE FROM files$dbprefix WHERE id='$id'"); //usuwanie wpisu pliku
    $result = $connect->query("UPDATE users$dbprefix SET usedspace = '$updated_space' WHERE login = '$owner'");
    header("Location: ../index.php");
    die();
    }
  }
  else{
    header("Location: ../index.php");
    die();
  }
}
