<?php require_once __DIR__ . '/_header.php'; ?>

<article>
    <section>
    <div class="uvod" style="
    border: 1px solid #000000;/*black;*/
    font-size: 1rem;
    width: 78vw;
    margin: 0.6vw;
    margin-left: 7vw;
    margin-right: 7vw;
    margin-top: 0vw;
    background-color: #F9E3E3;
    padding: 1.5vw;">
      <img src="<?php  echo $recept->link;?>" style =" width: 30vw;
      padding-right: 3vw;align:center; float: left" alt="slika">
      <!--<div class="display-4">
          <h3>Uputa za pripremu:</h3>
      </div>
      <div class="lead">
        <?php // echo $recept->description;?>
      </div>-->
      <dl class="row">
        <dt class="col-sm-3">Sastojci:</dt>
        <dd class="col-sm-9">
          <ul class="list-unstyled">
            <?php  
              foreach($sastojciRecepta as $sas )
                { 
                  echo '<li>' . $sas->amount . ' ' . $sas->ingredient  . '</li>'; 
                } 
            ?>
          </ul>
        </dd>
        <dt class="col-sm-3">Uputa za pripremu:</dt>
        <dd class="col-sm-9"><?php  echo $recept->description;?></dd>
        <dt class="col-sm-3">Trajanje pripreme:</dt>
        <dd class="col-sm-9"><?php  echo $recept->duration;?></dd>
        <dt class="col-sm-3">Kategorije:</dt>
        <dd class="col-sm-9"><?php  foreach($kategorijeRecepta as $kat ){ echo $kat->name; } ?></dd>
      </dl> 
    </div>
    </section>
</article>

<?php require_once __DIR__ . '/_footer.php'; ?>