<form action="recipes.php?rt=recipes/dodajFavorit" method="post">
<?php 
    echo '<input type="hidden" name="id_recepta" value = "' . $recept->id . '">';
    $nijeFavorit = true;
    if( $omiljeni != [] ){
        foreach($omiljeni as $om)
        {
            if($om->id == $recept->id)
            $nijeFavorit = false;
        }
    }
    if($nijeFavorit === true)
    {
    ?>
        <button id="dodajFavorit" name="dodajMojFavorit" type="submit"  style = "border: 1px solid #000000;/*black;*/
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
          <button id="makniFavorit" name="makniMojFavorit" type="submit" style = "border: 1px solid #000000;/*black;*/
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
    <?php } ?>
</form>