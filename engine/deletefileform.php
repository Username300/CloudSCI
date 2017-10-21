<?php //okreslanie nazwy usuwanego pliku
require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['id']) && isset($_SESSION['login'])) {
    $id = $_POST['id'];
    $result = $connect->query("SELECT name FROM files$dbprefix WHERE id='$id'");
    $row = $result->fetch_assoc();
    $filename = $row['name'];
  }
  else{
    header("Location: ../index.php");
    die();
  }
} //dostepne zmienne: $id->id pliku, $filename->nazwa pliku
?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
	   <title>Usuń plik - The Cloud Project</title>
	   <meta charset="utf-8">
  </head>
  <body>
      <h1>Usunąć plik
        <?php
        echo $filename;
        ?>
       ?</h1><br>
       <h2>Uwaga, usuwanie jest nieodwracalne!</h2><br>
       <form action="deletefile.php" method="post">
         <input type="hidden" name="id" value="
         <?php
         echo $id;
         ?>
         "/>
         <button type='submit'>Usuń na zawsze</button>
       </form>
       <form action="../index.php">
         <button type='submit'>Anuluj</button>
       </form>
  </body>
</html>
