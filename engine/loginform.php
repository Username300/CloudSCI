<!DOCTYPE HTML>
<html lang="pl">
  <head>
	   <title>Zaloguj się - The Cloud Project</title>
	   <meta charset="utf-8">
  </head>
  <body>
    <form action="login.php" method="post">
      <h1>Zaloguj się</h1>
      Podaj login: <input type="text" name="login"><br>
      Podaj hasło: <input type="password" name="password"><br>
      <button type='submit'>Zaloguj</button>
      <br><br>
    </form>
    <form action="registerform.php">
      <button type='submit'>Zarejestruj się</button>
    </form>
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
