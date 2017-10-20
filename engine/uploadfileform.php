<!DOCTYPE HTML>
<html lang="pl">
  <head>
	   <title>Wyślij plik - The Cloud Project</title>
	   <meta charset="utf-8">
  </head>
  <body>
    <form action="uploadfile.php" method="post" enctype="multipart/form-data">
    Wybierz plik: <input type="file" name="file" /><br>
    <input type="hidden" name="pid" value="
    <?php
    if(isset($_GET['pid'])) echo $_GET['pid'];
    else echo "0";
    ?>
    "/>
    <button type="submit" name="sendfile">Wyślij plik</button>
    </form>
  </body>
</html>

<?php
require_once("config.php");
$max_file_size = $max_file_size /1024;
if(isset($_GET['err'])){
  if($_GET["err"]==0){
    echo "<script>
      alert('Zakończono wysyłanie pliku.');
    </script>
    ";
  }
  else if($_GET["err"]==1){
    echo "<script>
      alert('Błąd: Nie jesteś zalogowany.');
    </script>
    ";
  }
  else if($_GET["err"]==2){
    echo "<script>
      alert('Błąd: Brak dostępnej przestrzeni lub plik zbyt duży. Maksymalny rozmiar pliku: $max_file_size MB');
    </script>
    ";
  }
  else if($_GET["err"]==3){
    echo "<script>
      alert('Błąd: Wysyłanie pliku nie powiodło się. Spróbuj ponownie.');
    </script>
    ";
  }
  else{
    echo "<script>
      alert('Wystąpił nieoczekiwany błąd.');
    </script>
    ";
  }
}
?>
