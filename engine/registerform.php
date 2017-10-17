<!DOCTYPE HTML>
<html lang="pl">
  <head>
	   <title>Zarejestruj się - The Cloud Project</title>
	   <meta charset="utf-8">
  </head>
  <body>
    <form action="register.php" method="post">
      <h1>Formularz rejestracyjny</h1>
      Podaj login: <input type="text" name="login"><br>
      Podaj hasło: <input type="password" name="password"><br>
      <h3>Hasło musi mieć conajmniej 8 znaków</h3><br>
      Powtórz hasło: <input type="password" name="password2"><br>
      Zabezpieczenie antyspamowe: Dwa + 2 * cztery to... <input type="text" name="spambot"><br>
      <button type='submit'>Zarejestruj się</button>
      <br><br>
    </form>
    <form action="../index.php">
      <button type='submit'>Wróć do strony głównej</button>
    </form>
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
