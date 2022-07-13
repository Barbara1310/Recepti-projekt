<form action="recipes.php?rt=recipes/dodajKomentar" method="post">
<?php echo '<input type="hidden" name="id_recepta" value = "' . $recept->id . '">'; ?>
<div style =" align:center; float: center;">
    <label for="mojKomentar">Komentirajte jelo: </label>
    <input type="text" id="mojKomentar" name ="mojKomentar">
    <button id="komentiraj" name="komentiraj" type="sumbit" class = "gubmic">Komentiraj!</button>
</div>
</form>