<?php
  session_start(); //sesja dla wielokrotnego dodawania plikow do tego samego katalogu
  if(isset($_POST['pid'])) $pid=$_POST['pid'];
  else if(isset($_SESSION['cpid'])) {
    $pid=$_SESSION['cpid'];
    unset($_SESSION['cpid']);
  }
  else $pid=0;
  include('config.php');
?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
    <!--
  //////////////////////////////
  //                          //
  // Pamiętaj, by dodać CSS   //
  //   i pliki bootstrapa     //
  //                          //
  //////////////////////////////
  -->
	   <title>Wyślij plik - <?php echo $project_title; ?></title>
	   <meta charset="utf-8">
	   <link rel="stylesheet" href="..\css\upload_file.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


  </head>
  <body>

	<div class="container">

	<br><br>

		<img src="../img/uploadfiles.png" alt="Upload file" class="img-responsive img">

		<div class="middle col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12">

			<form action="uploadfile.php" method="post" enctype="multipart/form-data" class="col-lg-10 col-lg-offset-1">
				<h2>Wybierz plik:</h2><br>

				<input multiple type="file" name="file[]" class="btn btn-default"/><br>

				<input type="hidden" name="pid" value="<?php echo $pid; ?>"/>
				<div id="center1">

				<button type="submit" name="sendfile" class="btn btn-success float">Wyślij plik</button>

				</div>
				</form>

				<form method="get" action="filemanager.php" class="col-lg-10 col-lg-offset-1">
					<div id="center2">
					<input type="hidden" name="pid" value="<?php echo $pid; ?>">
					<button type='submit' class="btn btn-primary">Wróć do plików</button>
					</div>
				</form>

				<div class="clearfix"></div>
		<br><br>
		</div>


	</div>

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
