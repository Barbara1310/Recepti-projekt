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
    <style type="text/css">
        
body {
  font-family: Arial, Helvetica, sans-serif; 
        background-image: url('https://t4.ftcdn.net/jpg/02/30/30/23/240_F_230302307_Zj3AqWlTN9DhkToAggTVajNIDliqVIbu.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;  
        background-size: auto;
        background-position: center bottom; /*Positioning*/

}

 .control-width { width: 60%; margin:  5% 35%;}

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 25%;
  height:  20%;
  border-radius: 5px;
  display:inline-block;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 5px 5px 0 0;
  width: 100%;
  height: 10vw;
  object-fit: cover;
}

.container {
  padding: 2px 16px;
}

.container h3 {
    display: inline;
    vertical-align: top;
    font-family: 'Open Sans', sans-serif;
    font-size: 12px;
    line-height: 28px;   
    color: #A60E2E;
}

.container p {
    display: inline;
    vertical-align: top;
    font-family: 'Open Sans', sans-serif;
    font-size: 8px;
    line-height: 30px;   
    color: #A60E2E; 
}
.container h3 {
    font-weight: bold;
}

    </style>
    <body>
        <div class = "container">

<form class="form" id = "pretraga" method="post" action="recipes.php?rt=recipes/handleSearch">
<div class="container" style="position:absolute; width: 300px;">
    <br>
    <label>Kategorija:</label>
    <input type="text" name="kategorija" id="kategorija" placeholder="">
    <br>
    <label>Sastojak:</label>
    <input type="text" name="sastojak" id="sastojak" placeholder="">
    <br>
    <button type="submit" name="save" class="btn btn-primary coloredbtn" style="width: 100%; background-color: #A60E2E; border-color: #A60E2E;" id = "trazi">Traži</button>
    <br><br>
</div>    
</form>
</div>
</body>
</html>

<script>


$(document).ready(function(){    
    $('#sastojak').tokenfield({
        autocomplete : {
            source: function(request, response)
            {
                $.ajax({
                    url: '../Recepti-projekt//model/ingredientsAutocomplete.php',
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(result) { response(result); }
                });
            }        
        }
    });

    $('#kategorija').tokenfield({
        autocomplete: {
            source: function(request, response)
            {
                $.ajax({
                    url: '../Recepti-projekt/model/categoriesAutocomplete.php',
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(result) { response(result); }
                });
            }
        }       
    });
  });
</script>


<script type="text/javascript">
  document.getElementById('sastojak').value = "<?php echo $sastojci;?>";
  document.getElementById('kategorija').value = "<?php echo $kategorije;?>";
</script>



<div class = "control-width">

<?php

if(!empty($recepti_za_prikaz)){
foreach($recepti_za_prikaz as $recept){
    ?>
        <a <?php echo 'href="recipes.php?rt=recipes/'.$recept->title.'"'; ?> >
        <div class="card">
          <img src="<?php echo $recept->link; ?>" alt="slika" style="width:100%">
          <div class="container">
            <h3><?php echo $recept->title; ?></h3>
            <p>⏱️<?php echo $recept->duration; ?></p> 
          </div>
        </div>
        </a>

<?php
}
}
?>

</div>