<?php
require_once __DIR__ . '/../model/recipesservice.class.php';

print_r($_POST);
echo 'ušao u kontroler';
$rs = new RecipesService();
$recept_id = $_POST['idRecepta'];
if( isset($_POST['mojaOcjena']) && $_POST['mojaOcjena']!== ''){
    echo 'dobro poslano';
    $rs->addNewRating($recept_id, $_POST['mojaOcjena']);
}

 ?>
