<?php 
require_once __DIR__ . '/_header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Pretraga recepata</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body> 

<form class="form" method="post" action="search.php">
<div class="container">
      <br>
    <label>Kategorija:</label>
    <input type="text" name="kategorija" id="kategorija" placeholder="Sastojak">
    <br>
    <label>Sastojak:</label>
    <input type="text" name="sastojak" id="sastojak" placeholder="Kategorija">
    <br>
    <button type="submit" name="save" class="btn btn-primary">Traži</button>
</div>    
</form>

<script type="text/javascript">
  $(function() {
     $( "#kategorija" ).autocomplete({
       source: '/model/categoriesAutocomplete.php',
     });
  });
</script>
<script type="text/javascript">
  $(function() {
     $( "#sastojak" ).autocomplete({
       source: '/model/ingredientsAutocomplete.php',
     });
  });
</script>
</body>
</html>
