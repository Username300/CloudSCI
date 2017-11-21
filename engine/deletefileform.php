<?php //okreslanie nazwy usuwanego pliku
require_once("config.php");
session_start();
$connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if(mysqli_connect_errno()==0)
{
  if(isset($_POST['id']) && isset($_SESSION['login'])) {
    if(isset($_POST['pid'])) $pid=$_POST['pid'];
    $id = $_POST['id'];
    $result = $connect->query("SELECT name FROM files$dbprefix WHERE id='$id'");
    $row = $result->fetch_assoc();
    $filename = $row['name'];
  }
  else{
    header("Location: ../index.php");
    die();
  }
} //dostepne zmienne: $id->id pliku, $filename->nazwa pliku
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
	   <title>Usuń plik - <?php echo $project_title;?></title>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	   <link rel="stylesheet" href="..\css\delete_file.css">
	   
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<!-- Font-Awesome -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	   
  </head>
  <body>
      <div class="container con">
		
	
			<img src="../img/question.jpg" alt="img" class="img left">
		
			<div class="left">
				  <h1>Usunąć plik <?php echo $filename; ?> ?</h1><br>
				   
				  <h3>Uważaj! Usuwanie jest nieodwracalne!</h3><br>
					<form action="deletefile.php" method="post" class="left">
						 <input type="hidden" name="id" value="<?php echo $id;?>"/>
						 <input type="hidden" name="pid" value="<?php echo $pid; ?>"/>
						 <button type='submit' class="btn btn-danger">Usuń na zawsze</button>
					</form>
						
		<a href="filemanager.php"><button type='submit' class="btn btn-primary left cancel">Anuluj</button><a>
	</div>
  </body>
</html>
