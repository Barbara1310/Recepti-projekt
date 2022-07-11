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
        <img src="<?php  echo $recept->link;?>" style =" width: 30vw;
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
        <dd class="col-md-9"><?php  foreach($kategorijeRecepta as $kat ){ echo $kat->name; } ?></dd>
        <dt class="col-md-3">Prosječna ocjena:</dt>
        <dd class="col-md-9"><?php  echo $prosjecnaOcjena; ?></dd>
      </dl> 
      <?php 
        $nijeFavorit = true;
        echo $omiljeni;
        foreach($omiljeni as $om)
        {
           if($om->id_recipe == $recept->id)
            $nijeFavorit = false;
        }
        if($nijeFavorit === true)
        {
          ?>
          <button id="favorit"  style = "border: 1px solid #000000;/*black;*/
        color:  #F9E3E3;/*lightsteelblue;*/
        font-family: 'Goudy Old Style', Garamond, 'Big Caslon', 'Times New Roman';
        background-image:
        url(https://wallpapercave.com/wp/wp3114035.jpg);
        width: 10vw;
        height: 10vh;
        font-size: 1.15rem;
        text-align:center;
        border-radius: 5vw;
        margin-bottom: 1vw" >Dodaj u favorite.</button>
        <?php
        } 
        else{ ?>
          <button id="favorit"  style = "border: 1px solid #000000;/*black;*/
        color:  #F9E3E3;/*lightsteelblue;*/
        font-family: 'Goudy Old Style', Garamond, 'Big Caslon', 'Times New Roman';
        background-image:
        url(https://wallpapercave.com/wp/wp3114035.jpg);
        width: 10vw;
        height: 10vh;
        font-size: 1.15rem;
        text-align:center;
        border-radius: 5vw;
        margin-bottom: 1vw" >Dodano u favorite.</button>
        <?php }
        ?>
    </div>
    </section>
    <div class="uvod" style="
    border: 1px solid #000000;/*black;*/
    font-size: 1.15rem;
    width: 78vw;
    margin: 0.6vw;
    margin-left: 7vw;
    margin-right: 7vw;
    margin-bottom: 20vw;
    margin-top: 0vw;
    background-color: #F9E3E3;
    padding: 1.5vw;">
      <label for="mojKomentar">Komentirajte jelo: </label>
      <input type="text" id="mojKomentar">
      <button id="komentiraj">Komentiraj!</button>

      <?php
      if( $komentariRecepta == [] ){
        echo 'Recept nema recenzija!';
      }
      else{
        foreach($komentariRecepta as $kom)
        {
          $author = 'Greška!';
          foreach($popisKorisnika as $korisnik )
          {
            if( $korisnik->id === $kom->id_user)
              $author = $korisnik->username;
          }
          ?>
          <div style = "border: 1px solid #000000;/*black;*/
          font-size: 1.15rem;">
              <?php echo $author . ': ' .$kom->comment; ?>
          </div>
        <?php } 
      }?>
    </section>
</article>
<script>
  $(document).ready(function()
  {
    $('#favorit').on('click', dodaj_favorit());
  });

  function dodaj_favorit()
  {
    
  }

</script>
<?php require_once __DIR__ . '/_footer.php'; ?>