<form action="recipes.php?rt=recipes/dodajOcjenu" method="post">
<?php echo '<input type="hidden" name="id_recepta" value = "' . $recept->id . '">'; ?>
<div style =" align:center; ">
    <?php
        if($ocjena != NULL ){
            echo 'Vaša ocjena:'; ?>
           <div class = "star-rating">
            <input  disabled type="radio" name="rating" id="5" value = "5" <?php if($ocjena >= 5){echo 'checked="checked"';}?>>
            <label for="5"></label>
            <input disabled type="radio" name="rating" id="4" value = "4" <?php if($ocjena >= 4){echo 'checked="checked"';}?>>
            <label for="4"></label>
            <input disabled type="radio" name="rating" id="3" value = "3" <?php if($ocjena >= 3){echo 'checked="checked"';}?>>
            <label for="3"></label>
            <input disabled type="radio" name="rating" id="2" value = "2" <?php if($ocjena >= 2){echo 'checked="checked"';}?>>
            <label for="2"></label>
            <input disabled type="radio" name="rating" id="1" value = "1" <?php if($ocjena >= 1){echo 'checked="checked"';}?>>
            <label for="1"></label>
          </div>
    <?php }
    else { 
        echo 'Još niste ocjenili recept!';
        ?>
    <div class = "star-rating">
        <input type="radio" name="rating" id="star1" value = "1">
        <label for="star1"></label>
        <input type="radio" name="rating" id="star2" value = "2">
        <label for="star2"></label>
        <input type="radio" name="rating" id="star3" value = "3">
        <label for="star3"></label>
        <input type="radio" name="rating" id="star4" value = "4">
        <label for="star4"></label>
        <input type="radio" name="rating" id="star5" value = "5">
        <label for="star5"></label>
    </div>
    <button id="ocjeni" name="ocjeni" type="sumbit" class = "gubmic">Ocjeni!</button>
    <?php } ?>
</div>
</form>