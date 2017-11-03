<?php
require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(!isset($_SESSION['login'])){ //sprawdzanie czy zalogowany
  header("Location: ../index.php");
  die();
}
$login = $_SESSION['login'];
if(!isset($_GET['pid'])) $current_dir=0; //sprawdzanie, w jakim katalogu sie znajdujemy
else{
  $current_dir=$_GET['pid'];
}
if(mysqli_connect_errno()==0) //pobieranie danych z bazy
{
  if($current_dir!=0){ //ustalanie nazwy katalogu, w ktorym jestesmy
    $result = $connect->query("SELECT name,pid,type FROM files$dbprefix WHERE id='$current_dir' AND owner='$login'");
    $row = $result->fetch_assoc();
    $dir_name = $row['name'];
    $dir_parent = $row['pid'];
    $dir_verify = $row['type'];
    if($dir_verify !== "DIR"){
      header("Location: ../index.php"); //Blad: obiekt nie jest katalogiem
      die();
    }
  }
  else{
    $dir_name = "Katalog główny";
    $dir_parent = 0;
  }
  //pobieranie listy plikow
 $files = array();
 $result = $connect->query("SELECT id,name,ext,type,updated,size FROM files$dbprefix WHERE pid='$current_dir' AND owner='$login'");
 while($row = $result->fetch_assoc()){
 $files[] = $row;
 }
 $num_of_files = count($files);
}
?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
	   <title>
       <?php
       echo $dir_name." - Pliki użytkownika ".$login;
       ?>
       - The Cloud Project</title>
	   <meta charset="utf-8">
  </head>
  <body>
    <h1>Lista plików w
    <?php
    echo $dir_name;
    ?>
    </h1>
    <br>
<?php
  if($current_dir!=0){ //sprawdzanie czy mozna przejsc katalog wyzej
    echo "
    <div style='width:820px;height:25px;border:1px solid black;'>
      <a href='filemanager.php?pid=".$dir_parent."'>&uarr; ...</a>
    </div>
    ";
  }
  for($i=0;$i<$num_of_files;$i++){ //divy z pojedynczymi plikami
    if($files[$i]['type']==="DIR"){
      echo "
      <div style='width:820px;height:25px;border:1px solid black;'>
        <div style='width:400px;height:25px;border-right:1px solid black;float:left;'><a href='filemanager.php?pid=".$files[$i]['id']."'>".$files[$i]['name']."</a></div>
        <div style='float:left;width:60px;height:25px;padding-left:10px;border-right:1px solid black;'>katalog</div>
        <div style='float:left;width:170px;height:25px;padding-left:10px;border-right:1px solid black;'>".$files[$i]['updated']."</div>
        <div style='float:left;width:70px;height:25px;padding-left:10px;border-right:1px solid black;'>---</div>
        <div style='float:left;width:40px;height:25px;'>
          <form method='post' action='deletefileform.php'>
            <input type='hidden' name='id' value='".$files[$i]['id']."'>
            <input type='hidden' name='pid' value='".$current_dir."'>
            <button type='submit'>Usuń</button>
          </form>
        </div>
      </div>
      ";
    }
    else if($files[$i]['type']==="FILE"){
      echo "
      <div style='width:820px;height:25px;border:1px solid black;'>
        <div style='width:400px;height:25px;border-right:1px solid black;float:left;'><a href='openfile.php?id=".$files[$i]['id']."'>".$files[$i]['name']."</a></div>
        <div style='float:left;width:60px;height:25px;padding-left:10px;border-right:1px solid black;'>".$files[$i]['ext']."</div>
        <div style='float:left;width:170px;height:25px;padding-left:10px;border-right:1px solid black;'>".$files[$i]['updated']."</div>
        <div style='float:left;width:70px;height:25px;padding-left:10px;border-right:1px solid black;'>".$files[$i]['size']." KB</div>
        <div style='float:left;width:60px;height:25px;'>
          <form method='post' action='deletefileform.php'>
            <input type='hidden' name='id' value='".$files[$i]['id']."'>
            <input type='hidden' name='pid' value='".$current_dir."'>
            <button type='submit'>Usuń</button>
          </form>
        </div>
      </div>
      ";
    }
  }
?>
  <br>
  <form method="post" action="makedirectory.php">
    Nazwa katalogu: <input type="text" name="name"><br>
    <?php
    echo "<input type='hidden' name='pid' value='".$current_dir."'>";
    ?>
    <button type='submit'>Utwórz katalog</button>
  </form>
  <br>
  <form method="post" action="uploadfileform.php">
    <input type='hidden' name='pid' value=
    <?php
    echo $current_dir;
    ?>
    >
    <button type='submit'>Wyślij plik...</button>
  </form>
  </body>
</html>
