<?php
require_once __DIR__ . '/../model/recipesservice.class.php';

class recipesController
{
  public function index() //defaultna stranica - ovdje se svaki dan prikazuju random recepti iz 3 kategorije
    {
      $title= $_SESSION['username'] . ', što ti se danas kuha?';
      $rs=new RecipesService();
      $recepti_dana=[];
      $recepti_dana=$rs-> getTodayRecipes();
      $recepti=[];
      for($i=0;$i<3;$i++)
        $recepti[]=$rs->getRecipeById($recepti_dana[$i]);
      require_once __DIR__ . '/../view/naslovna.php';

    }

  public function recepti() //ovdje će se pokazivati svi recepti ulogiranog autora
    {
      $title='Moji recepti';
      $rs = new RecipesService();
      $recepti = [];
      $recepti = $rs->getRecipeByUserId($_SESSION['id_user']);

     require_once __DIR__ . '/../view/moji_recepti.php';

    }

  public function favoriti() //ovdje će se pokazivati svi favoriti ulogiranog autora
    {
      $title='Moji favoriti';
      $rs = new RecipesService();
      $recepti = [];
      $recepti = $rs->getMyFavourites();

      require_once __DIR__ . '/../view/moji_recepti.php'; //isti je view kao i za moje recepte pa možemo koristiti taj ponovno
    }

  public function pretraga() //ovdje će se pretraživati svi recepti
    {
      $title='Pretraži recepte';
      $rs = new RecipesService();
      $kategorije = [];
      $kategorije = $rs->getAllCategories();
      $recepti_za_prikaz = [];
      require_once __DIR__ . '/../view/pretraga.php'; //
    }

  public function dodaj() //ovdje će se dodavati novi recepti
    {
      $title='';
      $rs = new RecipesService();
      $kategorije = [];
      $kategorije = $rs->getAllCategories();
      require_once __DIR__ . '/../view/dodaj_recept.php'; //
    }

    public function handleSearch(){
      $title='Pretraži recepte';
      $sastojak = $_POST['sastojak'];
      $kategorija = $_POST['kategorija'];

      $rs = new RecipesService();
      $recepti_za_prikaz = $rs->findRecipes($sastojak, $kategorija);

      require_once __DIR__ . '/../view/pretraga.php'; //
    }
}

 ?>
