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
    <form action="index.php">
      <button type='submit'>Wróć do strony głównej</button>
    </form>
  </body>
</html>
