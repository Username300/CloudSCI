<!DOCTYPE HTML>
<?php
error_reporting(-1);
include('config.php');
?>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="main-css.css">
	
		<!-- Font-Awesome -->
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Arimo:400" rel="stylesheet">
		<title> <?php echo "$project_title - index"; ?> </title>
	</head>
	<body>
	<!-- for mobile devices -->
	<header class="hidden-sm hidden-md hidden-lg">
	<a class="menu-bar" data-toggle="collapse" href="#menu">
            <span class="bars"></span>            
    </a>
    	<div class="collapse menu" id="menu">
            <ul class="list-inline">
                <li><a href="#">Strona główna</a></li>
                <li><a href="#">Oferta</a></li>
                <li><a href="#">Kontakt</a></li>
                <li><a href="#">Zaloguj się</a></li>
            </ul>   
    	</div>
		
	<img src="main2.jpg" alt="image" class="img-responsive hidden-sm hidden-md hidden-lg">

	</header>
	
	<!-- for other devices -->
	<header class="slider col-lg-12 col-md-12 col-sm-12 hidden-xs">
	
  <div id="Carousel" class="carousel slide" data-ride="carousel">
  	
	<nav>
		<div class="container">
              
              <div class="collapse navbar-collapse col-lg-8" id="top-navbar-collapse">
                
                  <ul class="nav navbar-nav">              
                  
                  <li><a  href="#">Strona główna</a></li>
				  <li><a  href="#">Oferta</a></li>
				  <li><a  href="#">Kontakt</a></li>
				  <li><a  href="#">Zaloguj się</a></li>
				  
				  </ul>
              </div>
        </div>
	</nav>
    <div class="carousel-inner">

      <div class="item active">
        <img src="trans.png" alt="background" style="width:100%;height: 100%;">
		<div class="carousel-caption">
          <h1 class="blackcap">Dołącz do naszej społeczności już dziś!</h1>
          <button type="button" class="btn btn-primary">Zarejestruj się</button>
		</div>
      </div>

      <div class="item">
        <img src="trans.png" alt="background" style="width:100%;height: 100%;">
        <div class="carousel-caption">
          <h1 class="blackcap"><?php echo $project_title; ?></h1>
          <p class="textbox">Doświadcz na własnej skórze możliwość dostępu do własnych plików z każdego miejsca na ziemi!</p>
        </div>
      </div>
  
    </div>

    <a class="left carousel-control" href="#Carousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" style="color: #337ab7;"></span>

    </a>
    <a class="right carousel-control" href="#Carousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" style="color: #337ab7;"></span>
    </a>
  </div>
</header>

<div class="clearfix"></div>

<div class="oferta col-md-12 col-lg-12 col-sm-12">
	<div class="container">
	<div class="row">
		<h2>Poznaj całkowicie nowego <?php echo $project_title; ?></h2>
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
		SCI Sp. z o.o.
	</div>
</footer>


</body>
</html>
	
	
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>