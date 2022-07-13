<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Registracija korisnika</title>
  </head>
  <body>
    <form action="recipes.php?rt=users/handleRegistration" method="post">
      <div style="width: 100px; height: 100px; padding: 30px 0; margin:auto">
        <span style="font-size: 25px"> Registriraj se </span>
        <br>
        <input type="text" placeholder="Enter Username" name="username" required>
        <br>
        <input type="password" placeholder="Enter Password" name="password" required>
         <br>
        <input type="password" placeholder="Re-enter Password" name="re-password" required>
        <br>
        <input type="text" placeholder="Enter email" name="email" required>
        <br>
        <button type="submit" name="button">Registracija</button>
      </div>
    </form>
  </body>
</html>
