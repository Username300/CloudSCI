<?php
require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['id']) && isset($_SESSION['login'])) {
    $id = $_POST['id'];
    $current_dir = $_POST['pid'];
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
      if($ext==="mp4" || $ext==="webm" || $ext==="ogg"){ //video player
        echo "<video controls autoplay style='width:600px;'>";
        echo "<source src='".$path."' type='video/".$ext."'>";
        echo "Your browser does not support HTML5 video.";
        echo "</video>";
      }
      else if($ext==="mp3" || $ext==="wav" || $ext==="flac"){ //audio player
        if($ext==="mp3") $ext = "mpeg";
        echo "<audio controls autoplay style='width:600px;'>";
        echo "<source src='".$path."' type='audio/".$ext."'>";
        echo "Your browser does not support HTML5 audio.";
        echo "</audio>";
      }
      else if($ext==="jpg"|| $ext==="jpeg" || $ext==="png" || $ext==="bmp" || $ext==="gif" || $ext==="tiff"){ //zdjecia
        echo "<embed src='".$path."' width='600px'>";
      }
      else if($ext==="pdf"){
        echo "<object data='".$path."' type='application/pdf' width='100%' height='500px;'>";
      }
      else{
        echo "Podgląd jest niedostępny.";
      }
      ?>
  </body>
  </html>
