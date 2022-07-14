<?php
require_once __DIR__ . '/_header.php'; ?>


<style>
body {
  font-family: Arial, Helvetica, sans-serif; 
        background-image: url('https://t4.ftcdn.net/jpg/02/30/30/23/240_F_230302307_Zj3AqWlTN9DhkToAggTVajNIDliqVIbu.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;  
        background-size: auto;
        background-position: center bottom; /*Positioning*/

}


 .control-width { width: 70%; margin: auto; }

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 33%;
  height:  10%;
  border-radius: 5px;
  display:inline-block;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 5px 5px 0 0;
  width: 100%;
  height: 8vw;
  object-fit: cover;
}

.container {
  padding: 2px 16px;
}

.container h3 {
    display: inline;
    vertical-align: top;
    font-family: 'Open Sans', sans-serif;
    font-size: 22px;
    line-height: 28px;   
    color: #A60E2E;
}

.container p {
    display: inline;
    vertical-align: top;
    font-family: 'Open Sans', sans-serif;
    font-size: 12px;
    line-height: 30px;   
    color: #A60E2E; 
}
.container h3 {
    font-weight: bold;
}
</style>




<div class = "control-width">
<?php
if(!empty($recepti)){
    foreach($recepti as $recept){
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
else{
  ?>
  <br><br>
  <div class = "prvidiv">
    <p style="color: #A60E2E;">Nema recepata...</p>
</div>
  <?php
}
?>
</div>

<?php require_once __DIR__ . '/_footer.php'; ?>
