<?php require_once __DIR__ . '/_header.php'; ?>

<article>
    <section>
    <div class="uvod" style="
    border: 1px solid #000000;/*black;*/
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
        <dd class="col-md-9"><?php  foreach($kategorijeRecepta as $kat ){ echo '<button class="gubmic">' . $kat->name . '</button> '; } ?></dd>
        <!--<dt class="col-md-3"></dt>
        <dd class="col-md-9">
          <div class = "rate">
            <span name="rating" id="star5" value = "5" class="fa fa-star <?php //if($prosjecnaOcjena >= 5){echo 'checked="checked"';}?>"></span>
            <label for="star5"></label>
            <span name="rating" id="star4" value = "4" class="fa fa-star <?php //if($prosjecnaOcjena >= 4){echo 'checked="checked"';}?>"></span>
            <label for="star4"></label>
            <span class="fa fa-star" name="rating" id="star3" value = "3" <?php //echo $prosjecnaOcjena >= 3 ?'checked':'';?>></span>
            <label for="star3"></label>
            <span class="fa fa-star" name="rating" id="star2" value = "2" <?php //echo $prosjecnaOcjena >= 2 ?'checked="checked"':'';?>></span>
            <label for="star2"></label>
            <span class="fa fa-star" name="rating" id="star1" value = "1" <?php //echo $prosjecnaOcjena >= 1 ?'checked="checked"':'';?>></span>
            <label for="star1"></label>
          </div>
        </dd>-->
        <dt class="col-md-3">Prosječna ocjena:</dt>
        <dd class="col-md-9">
          <?php  echo $prosjecnaOcjena; ?>
          <div class = "star-rat">
            <input disabled type="radio" name="rating" id="1" value = "1" <?php if($prosjecnaOcjena >= 1){echo 'checked';}?>>
            <label for="1"></label>
            <input disabled type="radio" name="rating" id="2" value = "2" <?php if($prosjecnaOcjena >= 2){echo 'checked';}?>>
            <label for="2"></label>
            <input disabled type="radio" name="rating" id="3" value = "3" <?php if($prosjecnaOcjena >= 3){echo 'checked ="checked"';}?>>
            <label for="3"></label>
            <input disabled type="radio" name="rating" id="4" value = "4" <?php if($prosjecnaOcjena >= 4){echo 'checked';}?>>
            <label for="4"></label>
            <input disabled type="radio" name="rating" id="5" value = "5" <?php if($prosjecnaOcjena >= 5){echo 'checked';}?>>
            <label for="5"></label>
          </div>
        </dd>
        <!--<dt class="col-md-3">Prosječna ocjena:</dt>
        <dd class="col-md-9"><?php  //echo $prosjecnaOcjena; ?></dd>-->
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
          <li class="media" style = "padding: 0.3vw; margin: 0.6vw; border: 1px solid #000000;background-color: #FEF3F3;">
          <img src="https://cdn1.vectorstock.com/i/thumb-large/80/75/logo-design-element-chef-restaurant-cook-vector-4878075.jpg" 
          class="mr-3" alt="kuhar" style = "border: 1px solid #000000; width: 4vw;" >
          <div class="media-body" style = "font-size: 1.15rem;">
              <h4 class="mt-0" style = "font-size: 1.2rem; font-weight: bold;"><?php echo $author; ?></h4>
              <p><?php echo $kom->comment; ?></p>
          </li>
        <?php } ?>
        </ul> <?php 
      }?>
<div class="uvod" style="
    font-size: 1.15rem;
    margin: 0.6vw;
    margin-left: 0vw;
    background-color: #F9E3E3;
    padding: 1.5vw;
    padding-left: 0vw">
  <h5>Korisnicima kojima se svidio ovaj recept, svidio se i recept ... </h5>


    <div class="prvidiv">
    <div class="tekst">
      <a <?php echo 'href="recipes.php?rt=recipes/'.$prijedlog_recepta->title.'"'; ?>><img src="<?php echo $prijedlog_recepta->link; ?>" alt="slika" style="width:100%"></a>
      <?php echo '<a class="nav-link" href="recipes.php?rt=recipes/'.$prijedlog_recepta->title.'"><h3>'. $prijedlog_recepta->title .'</h3></a>'; ?>
    </div>
  </div>
  </div>
  </section>
</article>

<?php require_once __DIR__ . '/_footer.php'; ?>