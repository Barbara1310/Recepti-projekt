<?php require_once __DIR__ . '/_header.php'; ?>


<?php
echo '<br>';
foreach($recepti as $recept){
    ?>
  <div class="column">
    <div class="tekst">
      <a <?php echo 'href="recipes.php?rt=recipes/'.$recept->title.'"'; ?>><img src="<?php echo $recept->link; ?>" alt="slika" style="width:100%"></a>
      <?php echo '<a class="nav-link" href="recipes.php?rt=recipes/'.$recept->title.'"><h3>'. $recept->title .'</h3></a>'; ?>
    </div>
  </div>

<?php   
}
?>

<?php require_once __DIR__ . '/_footer.php'; ?>