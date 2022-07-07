<?php
//print_r($_POST);
require_once __DIR__ . '/../model/recipesservice.class.php';

 $rs = new RecipesService();
 $title = $_POST['naslov'];
 $description = $_POST['opis'];
 $link = $_POST['link'];
 $duration = $_POST['vrijeme'];
 $id_user = $_SESSION['id_user'];

  $rs->createNewRecipe($title, $description, $link, $duration, $id_user);

  $id_recepta = $rs->getRecipeIdByLink($link);

  //echo $id_recepta;

  for($i = 0; $i < count($_POST['ingredient_name']); $i++)
  {
    //echo $_POST['ingredient_name'][$i];
    $rs->insertIngredient($id_recepta, $_POST['ingredient_quantity'][$i], $_POST['ingredient_name'][$i]);
  }
  for($i = 0; $i < count($_POST['categories']); $i++)
  {
    $rs->insertCategorysOfRecipe($id_recepta, $_POST['categories'][$i]); //u value smo stavili id kategorije pa to direktno spremamo
  }

  echo "Uspješno dodano!";


?>
