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
        <button id="dodajFavorit" name="dodajMojFavorit" type="submit"  style = "align:center; border: 1px solid #000000;/*black;*/
        color:  white;/*lightsteelblue;*/
        font-family: 'Goudy Old Style', Garamond, 'Big Caslon', 'Times New Roman';
        background-color: #A60E2E;
        width: 12vw;
        height: 5vh;
        font-size: 1.15rem;
        text-align:center;
        border-radius: 25px;
        border-color: #A60E2E;
        margin-bottom: 1vw" >Dodaj u favorite.</button>
        <?php
        } 
    else{ ?>
          <button id="makniFavorit" name="makniMojFavorit" type="submit" style = " align:center; border: 1px solid #000000;/*black;*/
        color:  white;/*lightsteelblue;*/
        font-family: 'Goudy Old Style', Garamond, 'Big Caslon', 'Times New Roman';
        background-color: #A60E2E;
        width: 12vw;
        height: 5vh;
        font-size: 1.15rem;
        text-align:center;
        border-radius: 25px;
        border-color: #A60E2E;
        margin-bottom: 1vw" >Dodano u favorite.</button>
    <?php } ?>
</form>