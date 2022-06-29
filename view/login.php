<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Recipes login</title>
  </head>
  <body>
    <form action="recipes.php?rt=users/handleLogin" method="post">
      <div style="width: 100px; height: 100px; padding: 30px 0; margin:auto">
        <span style="font-size: 25px"> Recipes </span>
        <br>
        <input type="text" placeholder="Enter Username" name="username" required>
        <br>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br>
        <button type="submit" name="button">Login</button>

      </div>

    </form>


  </body>
</html>
