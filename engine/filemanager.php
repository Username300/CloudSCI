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
	   <link rel="stylesheet" href="..\css\filemanager.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>

	    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <img class="navbar-brand img" src="../img/clouds_logo2.png" alt="<?php echo $project_title;?>">
			</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="myNavbar">

				<ul class="nav navbar-nav navbar-right">
					<li><span class="login">Zalogowano jako: <?php echo $login; ?></span></li>
					<li><a href="logout.php"><span class="fa fa-power-off" aria-hidden="true"></span><span class="hidden-lg hidden-md hidden-sm">    Wyloguj się </span></a></li>
				</ul>

				</div>

			</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>

  <br><br><br><br>



  <div class="container">




    <h1>Lista plików w
    <?php
    echo $dir_name;
    ?>
    </h1>
    <br>
<?php
  if($current_dir!=0){ //sprawdzanie czy mozna przejsc katalog wyzej
    echo "
    <div class='back-div'>
      <form method='get' action='filemanager.php'>
      <input type='hidden' name='pid' value='".$dir_parent."'>
      <button class='btn btn-primary back-btn' type='submit'>&uarr; Wstecz</button></form>
    </div>
    ";
  }
  for($i=0;$i<$num_of_files;$i++){ //divy z pojedynczymi plikami
    if($files[$i]['type']==="DIR"){
      echo "
      <div class='line-dir'>
        <div class='file-dir'>
          <form method='get' action='filemanager.php'>
          <input type='hidden' name='pid' value='".$files[$i]['id']."'>
          <button type='submit' class='btn btn-link'><i class='fa fa-folder-open' aria-hidden='true'></i> ".$files[$i]['name']."</button></form></div>
        <div class='ext-dir'>katalog</div>
        <div class='update-dir'>".$files[$i]['updated']."</div>
        <div class='size-dir'>---</div>
        <div class='delete-dir'>
          <form method='post' action='deletefileform.php'>
            <input type='hidden' name='id' value='".$files[$i]['id']."'>
            <input type='hidden' name='pid' value='".$current_dir."'>
            <button type='submit' class='btn btn-link btn-delete-dir'><i class='fa fa-times' aria-hidden='true'></i> Usuń</button>
          </form>
        </div>
      </div>
      ";
    }
    else if($files[$i]['type']==="FILE"){
      echo "
      <div class='line-file'>
        <div class='file-file'>
          <form method='post' action='openfile.php'>
          <input type='hidden' name='id' value='".$files[$i]['id']."'>
          <input type='hidden' name='pid' value='".$current_dir."'>
          <button type='submit' class='btn btn-link'>".$files[$i]['name']."</button></form></div>
        <div class='ext-file'>".$files[$i]['ext']."</div>
        <div class='update-file'>".$files[$i]['updated']."</div>
        <div class='size-file'>".$files[$i]['size']." KB</div>
        <div class='delete-dir-file'>
          <form method='post' action='deletefileform.php'>
            <input type='hidden' name='id' value='".$files[$i]['id']."'>
            <input type='hidden' name='pid' value='".$current_dir."'>
            <button class='btn btn-link delete' type='submit'> <i class='fa fa-times' aria-hidden='true'></i> Usuń</button>
          </form>
        </div>
        <div class='download-file'>
          <form method='post' action='downloadfile.php'>
            <input type='hidden' name='id' value='".$files[$i]['id']."'>
            <button class='btn btn-link' type='submit'><i class='fa fa-cloud-download' aria-hidden='true'></i> Pobierz</button>
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
    <button type='submit' class="btn btn-success"><i class="fa fa-folder-open" aria-hidden="true"></i> Utwórz katalog</button>
  </form>
  <br>
  <form method="post" action="uploadfileform.php">
    <input type='hidden' name='pid' value=
    <?php
    echo $current_dir;
    ?>
    >
    <button type='submit' class="btn btn-info"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Wyślij plik...</button>
  </form>
  <br> --- <br>
  <a href='logout.php'><button class="btn btn-link">Wyloguj się</button></a>

  </div> <!-- end of container  -->
  <!-- include javascript, jQuery FIRST -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
