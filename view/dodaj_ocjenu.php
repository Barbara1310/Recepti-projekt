<form action="recipes.php?rt=recipes/dodajOcjenu" method="post">
<?php echo '<input type="hidden" name="id_recepta" value = "' . $recept->id . '">'; ?>
<div style =" align:center; float: right;">
    <label for="mojKomentar">Ocjena: </label>
    <?php
        if($ocjena != NULL ){ ?>
            <!--
            <input type="text" id="mojaOcjena" name ="mojKomentar">
            <button id="komentiraj" name="komentiraj" type="sumbit" style = "align:center; border: 1px solid #000000;/*black;*/
                color:  #F9E3E3;/*lightsteelblue;*/
                font-family: 'Goudy Old Style', Garamond, 'Big Caslon', 'Times New Roman';
                background-image:
                url(https://wallpapercave.com/wp/wp3114035.jpg);
                width: 9vw;
                height: 5vh;
                font-size: 1.15rem;
                text-align:center;
                border-radius: 5vw;
                margin-bottom: 1vw">Komentiraj!</button>-->
    <?php } ?>
</div>
</form>