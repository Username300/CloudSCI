<!DOCTYPE HTML>
<?php include('config.php'); ?>
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
	
	
	
	   <title>Zaloguj się - <?php echo $project_title;?> </title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	   <link rel="stylesheet" href="..\css\login.css">
	   
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	  
  </head>
	
  <body>
    <div class="register-main col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="register-content col-lg-6 col-md-6 col-sm-12 col-xs-12">
  
			<form action="login.php" method="post" class="register-form">
			  <img src="..\img\clouds_logo2.png" alt="CloudS" class="img-logo">
			  <h1>Zaloguj się</h1>
			  <span>Podaj login: </span><br><input type="text" name="login" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br><br>
			  <span>Podaj hasło: </span><br><input type="password" name="password" class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><br>
			  <br>
			  <div style="text-align: center;"><button type='submit' class="btn btn-success">Zaloguj</button></div>
			  <br>
			</form>
			
    <div style="text-align: center; margin-bottom: 20px;"><a href="registerform.php"><button type='button' class="btn btn-danger">Zajerestruj się</button></a></div>
	
	</div>
	</div>
	
	<div class="clearfix"></div>
	
  </body>
</html>

<?php
if(isset($_GET['err'])){
  if($_GET["err"]==1){
    echo "<script>
      alert('Błąd: Dane logowania są nieprawidłowe.');
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
