<?php require_once __DIR__ . '/_header.php'; ?>


<?php
foreach($recepti as $recept){
    ?>
    <div class="column">
    <div class="content">
      <img src="<?php echo $recept->link; ?>" alt="slika" style="width:100%">
      <h3><?php echo $recept->title; ?> </h3>
    </div>
  </div>

<?php   
}
?>

<?php require_once __DIR__ . '/_footer.php'; ?>