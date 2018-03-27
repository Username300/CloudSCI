<?php
require_once("config.php");
require_once("addons.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(!isset($_SESSION['login'])){ //sprawdzanie czy zalogowany
  header("Location: ../index.php");
  die();
}
$login = $_SESSION['login'];
$stat = new Statistics($connect, $login, $dbprefix); //dostep do statystyk
if(!isset($_GET['pid'])) $current_dir=0; //sprawdzanie, w jakim katalogu sie znajdujemy
else{
  $current_dir=secure_string($connect, $_GET['pid']);
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
	  <!--
  //////////////////////////////
  //                          //
  // Pamiętaj, by dodać CSS   //
  //   i pliki bootstrapa     //
  //                          //
  //////////////////////////////
  -->
	   <title> <?php echo $dir_name." - Pliki użytkownika ".$login." - ".$project_title; ?></title>
	   <meta charset="utf-8">

	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	   <link rel="stylesheet" href="..\css\panelstat.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
		    <nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a href="../index.php"><img class="navbar-brand img" src="../img/clouds_logo2.png" alt="<?php echo $project_title;?>"></a>
			</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="myNavbar">

				<ul class="nav navbar-nav navbar-right">
					<li><span class="login">Zalogowano jako: <?php echo $login; ?></span></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Narzędzia
						<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="uploadfileform.php"><i class="fa fa-file"></i> Dodaj plik</a></li>
								<li><a href="filemanager.php#newfolder"><i class="fa fa-folder-open"></i> Utwórz nowy katalog</a></li>
								<li><a href="panelstat.php"><i class="fa fa-star"></i> Statystyki</a></li>
							</ul>
					</li>
					<li><a href="logout.php"><span class="fa fa-power-off" aria-hidden="true"></span><span class="hidden-lg hidden-md hidden-sm">    Wyloguj się </span></a></li>
				</ul>

			</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>

  <div class="container">

<div class="rela-block">
	<div class="rela-block profile-card">
		<div class="profile-pic" id="profile_pic"></div>
		<div class="rela-block profile-name-container">
			<div class="rela-block user-name" id="user_name"><?php echo $login; ?></div>
			<div class="rela-block user-desc" id="user_description">Statystki użytkownika</div>
		</div>
		<div class="statistics">
		<?php echo "Tak na marginesie: <br>";
			echo "Całk.il. plików: ".$stat->num_of_files()."<br>Zajęte miejsce na dysku: ".$stat->size_profile()."<br>";
			echo "Całk. dostępna przestrzeń: ".$stat->total_storage()."<br>"
		?>
		</div>
		</div>
</div>
<br><br>
</body>
</html>
