<?php require_once __DIR__ . '/_header.php'; ?>

<style type="text/css">


  .card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 33%;
  height:  33%;
  border-radius: 5px;
  display:inline-block;
  background-color: #cd8997;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 5px 5px 0 0;
  width: 100%;
  height: 20vw;
  object-fit: cover;
}

.container {
  padding: 2px 16px;
}

</style>

<article>
    <section>
    <div class="uvod" style="
      border-radius: 25px;
    font-size: 1.15rem;
    width: 78vw;
    margin: 0.6vw;
    margin-left: 7vw;
    margin-right: 7vw;
    margin-top: 0vw;
    background-color: #F9E3E3;
    padding: 1.5vw;">
      <picture>
        <img src="<?php  echo $recept->link;?>" style =" width: 35vw;
        padding-right: 3vw; align:center; float: left" alt="slika">
      </picture>
      <!--<div class="display-4">
          <h3>Uputa za pripremu:</h3>
      </div>
      <div class="lead">
        <?php // echo $recept->description;?>
      </div>-->
      <dl class="row">
        <dt class="col-md-3">Sastojci:</dt>
        <dd class="col-md-9">
          <ul class="list-unstyled">
            <?php  
              foreach($sastojciRecepta as $sas )
                { 
                  echo '<li>' . $sas->amount . ' ' . $sas->ingredient  . '</li>'; 
                } 
            ?>
          </ul>
        </dd>
        <dt class="col-md-3">Uputa za pripremu:</dt>
        <dd class="col-md-9"><?php  echo $recept->description;?></dd>
        <dt class="col-md-3">Trajanje pripreme:</dt>
        <dd class="col-md-9"><?php  echo $recept->duration;?></dd>
        <dt class="col-md-3">Kategorije:</dt>
        <dd class="col-md-9"><?php  foreach($kategorijeRecepta as $kat ){ 
          echo '<form class="form" id = "pretraga" method="post" action="recipes.php?rt=recipes/handleSearch">';
          echo '<input hidden type="text" name="kategorija" id="kategorija" value="' . $kat->name  .'">';
          echo '<input hidden type="text" name="sastojak" id="sastojak" value="' . null  .'">';
          echo '<button type="submit" class="zadanaKategorija gubmic">' . $kat->name . '</button> '; } 
          echo '</form>';
          ?></dd>
        <!--<dt class="col-md-3">Prosječna ocjena:</dt>
        <dd class="col-md-9"><?php/*
        for($i = 1; $i <= $prosjecnaOcjena; $i++)
        {
            echo '<span class="mojaZvijezdica" checked>★</span>';
        }
        for($i = $prosjecnaOcjena + 1; $i < 6; $i++)
            echo '<span class="mojaZvijezdica">☆</span>';*/
        ?>
        </dd>-->
        <dt class="col-md-3">Prosječna ocjena:</dt>
        <dd class="col-md-9"><?php  if($prosjecnaOcjena != 'Nema ocjena:(') echo '<p id="pro">' . round($prosjecnaOcjena, 2).'</p>'; else echo '<p id="pro">' . $prosjecnaOcjena .'</p>';?></dd>
        <dt class="col-md-3"></dt>
        <dd class="col-md-9"><?php require_once __DIR__ . '/dodaj_favorit.php'; ?></dd>
      </dl>
      <?php require_once __DIR__ . '/dodaj_komentar.php'; ?>
      <?php require_once __DIR__ . '/dodaj_ocjenu.php'; ?>

      <?php
      if( $komentariRecepta == [] ){
        echo 'Recept nema recenzija!';
      }
      else{
        echo '<ul class="list-unstyled">';
        foreach($komentariRecepta as $kom)
        {
          $author = 'Greška!';
          foreach($popisKorisnika as $korisnik )
          {
            if( $korisnik->id === $kom->id_user)
              $author = $korisnik->username;
          }
          ?>
          <li class="media" style = "padding: 0.3vw; margin: 0.6vw; background-color: #FEF3F3;">
          <img src="https://cdn1.vectorstock.com/i/thumb-large/80/75/logo-design-element-chef-restaurant-cook-vector-4878075.jpg" 
          class="mr-3" alt="kuhar" style = " width: 4vw;" >
          <div class="media-body" style = "font-size: 1.15rem;">
              <h4 class="mt-0" style = "font-size: 1.2rem; font-weight: bold;"><?php echo '<p id="' . $kom->id_user .'" class="autorKomentara">' . $author . '</p>'; ?></h4>
              <p><?php echo $kom->comment; ?></p>
          </li>
        <?php } ?>
        </ul> <?php 
      }?>
<div class="uvod" style="
    font-size: 1.15rem;
    margin: 0.6vw;
    margin-left: 0vw;
    color:  #A60E2E;
    background-color: #F9E3E3;
    padding: 1.5vw;
    padding-left: 0vw">
  <h5 style="color: #A60E2E;">Korisnicima kojima se svidio ovaj recept, svidio se i recept ... </h5>

<a <?php echo 'href="recipes.php?rt=recipes/'.$prijedlog_recepta->title.'"'; ?> >
<div class="card">
<img src="<?php echo $prijedlog_recepta->link; ?>" alt="slika" style="width:100%">
<div class="container">
    <h3 style="color: #A60E2E;"><?php echo $prijedlog_recepta->title; ?></h3>
    <p style="color: #A60E2E;">⏱️<?php echo $prijedlog_recepta->duration; ?></p> 
  </div>
</div>
</a>

  </div>
  </section>
</article>

<script>
  $(document).ready(function()
        {
            $('.mt-0').on('click', function()
            {
                let idAutora = $(event).prop('id');
                let autorKomentara = $(event).val();
                console.log(idAutora);
                console.log(autorKomentara);
  
                console.log('idemo');
            });   
        });

</script>

<?php require_once __DIR__ . '/_footer.php'; ?>