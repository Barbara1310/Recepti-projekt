<?php 
require_once __DIR__ . '/_header.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
    </head>
    <body>
<form class="form" method="post" action="recipes.php?rt=recipes/handleSearch">
<div class="container" style="position:absolute; width: 300px;">
    <br>
    <label>Kategorija:</label>
    <input type="text" name="kategorija" id="kategorija" placeholder="Kategorija">
    <br>
    <label>Sastojak:</label>
    <input type="text" name="sastojak" id="sastojak" placeholder="Sastojak">
    <br>
    <button type="submit" name="save" class="btn btn-primary">Traži</button>
</div>    
</form>
    </body>
</html>

<script>
  $(document).ready(function(){
    $('#sastojak').tokenfield({
        autocomplete :{
            source: function(request, response)
            {
                jQuery.get('/../model/ingredientsAutocomplete.php', {
                    term : request.term
                }, function(data){
                    data = JSON.parse(data);
                    response(data);
                });
            },
            delay: 100
        }
    });
  });
    $(document).ready(function(){
    $('#kategorija').tokenfield({
        autocomplete :{
            source: function(request, response)
            {
                jQuery.get('/../model/categoriesAutocomplete.php', {
                    term : request.term
                }, function(data){
                    data = JSON.parse(data);
                    response(data);
                });
            },
            delay: 100
        }
    });
  });
</script>


<?php
if(!empty($recepti_za_prikaz)){
foreach($recepti_za_prikaz as $recept){
    ?>
    <div class="prvidiv">
    <div class="tekst">
      <a <?php echo 'href="recipes.php?rt=recipes/'.$recept->title.'"'; ?>><img src="<?php echo $recept->link; ?>" alt="slika" style="width:100%"></a>
      <?php echo '<a class="nav-link" href="recipes.php?rt=recipes/'.$recept->title.'"><h3>'. $recept->title .'</h3></a>'; ?>
    </div>
  </div>
  <br><br>

<?php
}
}
?>

