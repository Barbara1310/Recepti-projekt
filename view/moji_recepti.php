<?php
require_once __DIR__ . '/_header.php'; ?>


<?php
if(!empty($recepti)){
foreach($recepti as $recept){
    ?>
    <div class="prvidiv">
    <div class="tekst">
      <img src="<?php  echo $recept->link; ?>" alt="slika" style="width:100%">
      <h3><?php echo $recept->title; ?> </h3>
    </div>
  </div>
  <br><br>

<?php
}
}
?>

<?php require_once __DIR__ . '/_footer.php'; ?>
