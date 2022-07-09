<?php require_once __DIR__ . '/_header.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Example</title>
  <meta charset="utf-8">
  <meta name="viewport">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<div class="container">
  <form class="form" method="post" action="search.php">
    <label>Sastojak:</label>
    <input type="text" name="sastojak" placeholder="Sastojak">
    <br>
    <label>Kategorija:</label>
    <input type="text" name="kategorija" placeholder="Kategorija">
    <br>
    <button type="submit" name="save" class="btn btn-primary">Traži</button>

  </form>
</div>

</body>
</html>
