<?php
require_once __DIR__ . '/../model/recipesservice.class.php';

print_r($_POST);

$rs = new RecipesService();
$ime_kategorije = $_POST['category'];

$rs->addNewCategory($ime_kategorije);

echo $ime_kategorije;
echo "Dodano!"


 ?>
