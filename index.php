<?php
session_start();
if (isset($_SESSION["login"])){
  header("Location: engine/filemanager.php");
}
else{
  header("Location: engine/loginform.php");
}
?>
