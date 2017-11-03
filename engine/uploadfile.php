<?php
require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['sendfile']) && isset($_SESSION['login'])) //sprawdza czy plik zostal zamieszczony przez formularz
  {
    $result = $connect->query("SELECT MAX(id) FROM files$dbprefix");
    $row = $result->fetch_assoc();
    $target_filename = intval($row['MAX(id)']) + 1; //ustawianie nazwy nowego pliku
    $target_file = $target_dir . $target_filename;
    $source_file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); //ustalanie rozszerzenia pliku
    if(isset($_POST['pid'])) $pid = $_POST['pid'];
    else $pid = 0;
    settype($pid, "integer");
    $source_filename = $_FILES['file']['name']; //nazwa wysylanego pliku
    $owner = $_SESSION['login'];
    $date = date('Y-m-d H:i:s', time()); //aktualna data
    $file_size = intval($_FILES['file']['size']/1024); //rozmiar pliku (w KB)
    $file_size++; //zaokrąglanie rozmiaru w gore
    $result = $connect->query("SELECT storage,usedspace FROM users$dbprefix WHERE login='$owner'");
    $row = $result->fetch_assoc();
    $total_space = $row['storage'];
    $used_space = $row['usedspace']; //sprawdzanie dostepnej przestrzeni dyskowej dla uzytkownika
    $file_loc = $_FILES['file']['tmp_name']; //tymczasowa lokalizacja pliku
    $_SESSION['cpid'] = $pid; //dla redirecta: uploadfileform.php
    if($used_space + $file_size <= $total_space && $file_size <= $max_file_size){
      if(move_uploaded_file($file_loc, $target_file)){ //wysylanie pliku
        $result = $connect->query("INSERT INTO files$dbprefix VALUES ('', '$pid', '$source_filename', '$source_file_ext', '$owner', 'FILE', '$date', '$file_size', '$target_file')");
        $postspace = $used_space + $file_size;
        $result = $connect->query("UPDATE users$dbprefix SET usedspace = '$postspace' WHERE login = '$owner'");
        header("Location: uploadfileform.php?err=0"); //brak bledu
        die();
      }
      else{
        header("Location: uploadfileform.php?err=3"); //blad: wysylanie pliku nie powiodlo sie
        die();
      }
    }
    else{
      header("Location: uploadfileform.php?err=2"); //blad: brak dostepnej przestrzeni lub plik za duzy
      die();
    }
  }
  else{
    header("Location: uploadfileform.php?err=1"); //blad: nie jestes zalogowany
    die();
  }
}
?>
