<?php
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
  
	   <title>Zarejestruj się - The Cloud Project</title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	   <link rel="stylesheet" href="..\css\clouds.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	
	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
  
  <div class="register-main col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="register-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<form action="register.php" method="post" class="register-form">
			  <img src="..\img\clouds_logo2.png" alt="CloudS" class="img-logo">
			  <h1>Formularz rejestracyjny</h1>
			  
			  
			  Podaj login: <br><input type="text" name="login" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
			  <h4>Hasło musi mieć conajmniej 8 znaków</h4>
			  Podaj hasło: <br><input type="password" name="password" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  Powtórz hasło: <br><input type="password" name="password2" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  Zabezpieczenie antyspamowe: Dwa + 2 * cztery to...<br> <input type="text" name="spambot" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  <br>
			  <div style="text-align: center;"><button type='sumbit' class="btn btn-success">Zarejestruj się</button></div>
			  
		</form>
		<br>
		<div style="text-align: center;"><button type='button' class="btn btn-danger">Wróć do strony głównej</button></div>
		<br>
	  
	</div>
	</div>
	
	<div class="clearfix"></div>
<!--
<div class="oferta col-md-12 col-lg-12 col-sm-12">
	<div class="container">
	<div class="row">
		<h2>Dlaczego warto dołączyć do społeczności <?php /* echo $project_title; */?>?</h2>
		<div class="block col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<img src="clock.png" alt="clock" style="margin: 0 auto; width: 90px; height: 90px; display: block;">
			<h3>Szybkość i prostota</h3>
		</div>
		
		<div class="block col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<img src="server.png" alt="clock" style="margin: 0 auto; width: 90px; height: 90px; display: block;">
			<h3>Łatwa administracja plikami</h3>
		</div>
		
		<div class="block col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<img src="mobile.png" alt="clock" style="margin: 0 auto; width: 90px; height: 90px; display: block;">
			<h3>Mobilny dostęp do plików</h3>
		</div>
	</div>
	</div>
</div>
<div class="clearfix"></div>
<footer>
	<div class="container footer">
		<?php /*echo $project_title; */ ?>
	</div>
</footer>-->
	
	
  </body>
</html>

<?php
if(isset($_GET['err'])){
  if($_GET["err"]==1){
    echo "<script>
      alert('Błąd: Hasła nie są zgodne.');
    </script>
    ";
  }
  else if($_GET["err"]==2){
    echo "<script>
      alert('Błąd: Długość hasła nie spełnia wymagań.');
    </script>
    ";
  }
  else if($_GET["err"]==3){
    echo "<script>
      alert('Błąd: Odpowiedź na pytanie antyspamowe jest nieprawidłowa.');
    </script>
    ";
  }
  else if($_GET["err"]==4){
    echo "<script>
      alert('Błąd: Ta nazwa użytkownika jest już zajęta.');
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