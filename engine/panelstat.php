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
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="../css/filemanager.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
  
	<script>
	function footer(){
		if ( document.getElementById("myFooter").classList.contains('footerclose') ){
			
			document.getElementById("myFooter").classList.remove('footerclose');
			document.getElementById("myFooter").classList.add('footeropen');
			document.getElementById("buttonft").style.transition="All 1s ease";
			document.getElementById("buttonft").style.transform="rotate(180deg)";
			
		}else if(document.getElementById("myFooter").classList.contains('footeropen')){
			
			document.getElementById("myFooter").classList.add('footerclose');
			document.getElementById("myFooter").classList.remove('footeropen');
			document.getElementById("buttonft").style.transition="All 1s ease";
			document.getElementById("buttonft").style.transform="rotate(0deg)";
			
		}
	}
	
	</script>

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

  <br><br><br>
<?php //petla sciezki dostepowej
$i = 0;
$dir_temp = $current_dir;
while($dir_temp!=0){
  $result = $connect->query("SELECT pid,name FROM files$dbprefix WHERE id='$dir_temp'");
  $dir = $result->fetch_assoc();
  $path[$i]['id'] = $dir_temp;
  $path[$i]['name'] = $dir['name'];
  $dir_temp = $dir['pid'];
  $i++;
}
$path[$i]['id'] = 0;
$path[$i]['name'] = "Katalog główny";
//wyswietlanie sciezki
?>
	  
<div class="path">
	<?php
	echo "<br>";
for($j = count($path)-1;$j>=0;$j--){
  echo "<a href='filemanager.php?pid=".$path[$j]['id']."'><div class='chevron'><span>".$path[$j]['name']."</span> </div></a>";
}
echo "<br>";
	?>
</div>


  <div class="container">




    <h1>Lista plików w
    <?php
    echo $dir_name;
    ?>
    </h1>
    <br>
	  <?php
 if(isset($_SESSION['move'])){
   $move_id=intval($_SESSION['move']);
   $result = $connect->query("SELECT name,size FROM files$dbprefix WHERE id=$move_id AND owner='$login'");
   $move_item = $result->fetch_assoc();
   echo "<div class='fileemanager'><div class='inner1'>";
   echo "<h4><i class='fa fa-compass fa-2x'></i> Menadżer przenoszenia i kopiowania</h4></div><div class='inner2'>Wybrany plik: ".$move_item['name']."<br>";
   echo "<div class='center-inner'><a href='filemv.php?id=".$move_id."&pid=".$current_dir."&action=1' class='btn btn-success'>KOPIUJ TUTAJ</a>";
   echo "<a href='filemv.php?id=".$move_id."&pid=".$current_dir."&action=2' class='btn btn-info'>PRZENIEŚ TUTAJ</a>";
   echo "<a href='filemv.php?id=".$move_id."&pid=".$current_dir."&action=0' class='btn btn-warning'>ANULUJ</a></div></div>";
   echo "</div> ";
 }

  if($current_dir!=0){ //sprawdzanie czy mozna przejsc katalog wyzej
    echo "
    <div class='back-div'>
      <form method='get' action='filemanager.php'>
      <input type='hidden' name='pid' value='".$dir_parent."'>
      <button class='btn btn-primary back-btn' type='submit'>&uarr; Wstecz</button></form>
    </div>
    ";
  }
  echo "<div class='table-responsive'> <table class='table table-bordered table-condensed table-dark'><thead><tr><th>Nazwa pliku</th><th>Typ</th><th>Data wysłania</th><th>Rozmiar</th><th>Operacje</th></tr></thead><tbody>";
  for($i=0;$i<$num_of_files;$i++){ //divy z pojedynczymi plikami
    if($files[$i]['type']==="DIR"){
      echo "
      <tr class='tr-dir'>
        <td>
          <form method='get' action='filemanager.php'>
          <input type='hidden' name='pid' value='".$files[$i]['id']."'>
          <button type='submit' class='btn btn-link'><i class='fa fa-folder-open' aria-hidden='true'></i> ".$files[$i]['name']."</button></form></td>
        <td>katalog</td>
        <td>".$files[$i]['updated']."</td>
        <td>".responsive_filesize($stat->local_sizeOfDir($files[$i]['id']))."</td>
        <td>
          <form method='post' action='deletefileform.php'>
            <input type='hidden' name='id' value='".$files[$i]['id']."'>
            <input type='hidden' name='pid' value='".$current_dir."'>
            <button type='submit' class='btn btn-link btn-delete-dir'><i class='fa fa-times' aria-hidden='true'></i> <span class='hidden-xs-down hidden-xs'>Usuń</span></button>
          </form>
        </td
      </tr>
      ";
    }
    else if($files[$i]['type']==="FILE"){
      echo "
      <tr  class='tr-file'>
        <td>
          <form method='post' action='openfile.php'>
          <input type='hidden' name='id' value='".$files[$i]['id']."'>
          <input type='hidden' name='pid' value='".$current_dir."'>
          <button type='submit' class='btn btn-link'>".$files[$i]['name']."</button><a href='filemvset.php?pid=".$current_dir."&move=".$files[$i]['id']."'><i class='fa fa-copy' ></i></a></form></td>
        <td>".$files[$i]['ext']."</td>
        <td>".$files[$i]['updated']."</td>
        <td>".responsive_filesize($files[$i]['size'])."</td>
        <td style='width:163px;'>
          <form method='post' action='deletefileform.php' style='float:left;'>
            <input type='hidden' name='id' value='".$files[$i]['id']."'>
            <input type='hidden' name='pid' value='".$current_dir."'>
            <button class='btn btn-link delete' type='submit'> <i class='fa fa-times' aria-hidden='true'></i><span class='hidden-xs hidden-sm hidden-xs-down'> Usuń</span></button>
          </form>
        
          <form method='post' action='downloadfile.php' style='float:left;'>
            <input type='hidden' name='id' value='".$files[$i]['id']."'>
            <button class='btn btn-link' type='submit'><i class='fa fa-cloud-download' aria-hidden='true'></i><span class='hidden-xs hidden-sm hidden-xs-down'> Pobierz</span></button>
          </form>
        </td>
      </tr>
      ";
    }
  }
  
  echo "</tbody></table></div>";
echo "<br><a name='newfolder'></a>";
  echo "<div class='folderman'>
	<div class='folderinner1'><h4>Utwórz nowy katalog lub dodaj plik</h4></div>
	<div class='folderinner2'>
	<form method='post' action='makedirectory.php'>
    <span>Nazwa katalogu: </span><input type='text' class='form-control catalog-input' name='name'><br>";
    echo "<input type='hidden' name='pid' value='".$current_dir."'>";
    ?>
    <button type='submit' class="btn btn-success"><i class="fa fa-folder-open" aria-hidden="true"></i> Utwórz katalog</button>
  </form>
  <form method="post" action="uploadfileform.php">
    <input type='hidden' name='pid' value=
    <?php
    echo $current_dir;
    ?>
    >
    <button type='submit' class="btn btn-info"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Wyślij plik...</button>
  </form>
  </div>
  </div>



<?php
  
  /*echo "Porównanie typów plików: ";
  $tab = $stat->filesize_comparison();
  echo "<pre>";
  var_dump($tab);
  echo "</pre>";*/
?>


<br><br><br><br><br>
  </div> <!-- end of container  -->
  
	<div class="footer footerclose" id="myFooter">
		<button id="buttonft" type="button" class="btn btn-link" onClick="footer()" ><i class="fa fa-angle-up fa-3x"></i></button>
		<?php 
			echo "<br>Ilość plików w tym katalogu: ".$stat->local_filesInDir($current_dir)."<br>Rozmiar katalogu: ".$stat->local_sizeOfDir($current_dir)."<br>";
			/*echo "Całk.il. plików: ".$stat->num_of_files()."<br>Zajęte miejsce na dysku: ".$stat->size_profile()."<br>";
			echo "Całk. dostępna przestrzeń: ".$stat->total_storage()."<br>";*/
		?>
		<a class="white" href="panelstat.php">Więcej statystyk znajdziesz tutaj <i class="fa fa-code"></i></a>
	</div>
  
  
  <!-- include javascript, jQuery FIRST -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
