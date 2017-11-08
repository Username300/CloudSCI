<?php
require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_GET['id']) && isset($_SESSION['login'])) {
    $id = $_GET['id'];
    $current_dir = $_GET['pid'];
    $login = $_SESSION['login'];
    $result = $connect->query("SELECT name,ext,path FROM files$dbprefix WHERE id='$id' AND owner='$login' AND type='FILE'");
    $row = $result->fetch_assoc();
    $filename = $row['name'];
    $ext = $row['ext'];
    $path = $row['path'];
  }
  else{
    header("Location: ../index.php");
    die();
  }
}
?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
	   <title><?php echo $filename; ?> - Media Player - The Cloud Project</title>
	   <meta charset="utf-8">
  </head>
  <body>
    <form method="get" action="filemanager.php">
      <input type='hidden' name='pid' value=
      <?php echo $current_dir; ?>
      >
      <button type='submit'>Wróć do przeglądarki</button>
    </form>
    <h1><?php echo $filename; ?></h1>
      <?php
      if($ext==="mp4"){ //select video files
        echo "<video width='600' controls>";
        echo "<source src='".$path."' type='video/".$ext."'>";
        echo "Your browser does not support HTML5 video.";
        echo "</video>";
      }
      //else if audio, ... photo
      else{
        echo "Podgląd jest niedostępny.";
      }
      ?>
  </body>
  </html>
