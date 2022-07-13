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
      $recepti_za_prikaz = [];
      $sastojci = "";
      $kategorije = "";
      require_once __DIR__ . '/../view/pretraga.php'; //

    }

  public function dodaj() //ovdje će se dodavati novi recepti
    {
      $title='';
      $rs = new RecipesService();
      $kategorije = [];
      $kategorije = $rs->getAllCategories();
      require_once __DIR__ . '/../view/dodaj_recept.php'; 
    }

    public function handleSearch(){
      $title='Pretraži recepte';
      $sastojci = $_POST['sastojak'];
      $kategorije = $_POST['kategorija'];

      $rs = new RecipesService();
      $recepti_za_prikaz = $rs->findRecipes($sastojci, $kategorije);

      require_once __DIR__ . '/../view/pretraga.php'; //
    }

  public function recept($recept_id){
    $rs = new RecipesService();
    $title = ($rs->getRecipeById($recept_id))->title;

    $recept = $rs->getRecipeById($recept_id);
    $kategorijeRecepta = $rs->getRecipeCategories($recept_id);
    $sastojciRecepta = $rs->getRecipeIngridients($recept_id);
    $popisKorisnika = $rs->getAllUsers();
    $komentariRecepta = $rs->getRecipeComments($recept_id);
    $prosjecnaOcjena = $rs->getAverageRating($recept_id);
    $omiljeni = $rs->getMyFavourites();
    $prijedlog_recepta = $rs->getRecommendations($recept_id);
    //$nijeFavorit = $rs->getFavourite($recept_id, $_SESSION['id_user']);
    require_once __DIR__ . '/../view/prikazi_recept.php';
  }

  public function dodajFavorit(){
    $rs = new RecipesService();
    $recept_id = $_POST['id_recepta'];
    if( isset($_POST['dodajMojFavorit'])){
        $rs->addNewFavourite($recept_id);
    }
    else if(isset($_POST['makniMojFavorit']))
    {
        $rs->removeFavourite($recept_id);
    }

    $title = ($rs->getRecipeById($recept_id))->title;

    $recept = $rs->getRecipeById($recept_id);
    $kategorijeRecepta = $rs->getRecipeCategories($recept_id);
    $sastojciRecepta = $rs->getRecipeIngridients($recept_id);
    $popisKorisnika = $rs->getAllUsers();
    $komentariRecepta = $rs->getRecipeComments($recept_id);
    $prosjecnaOcjena = $rs->getAverageRating($recept_id);
    $omiljeni = $rs->getMyFavourites();
    $prijedlog_recepta = $rs->getRecommendations($recept_id);
    require_once __DIR__ . '/../view/prikazi_recept.php';
  }

  public function dodajKomentar(){
    $rs = new RecipesService();
    $recept_id = $_POST['id_recepta'];
    if( isset($_POST['komentiraj']) && isset($_POST['mojKomentar']) && $_POST['mojKomentar']!== ''){
        $rs->addNewComment($recept_id, $_POST['mojKomentar']);
    }

    $title = ($rs->getRecipeById($recept_id))->title;

    $recept = $rs->getRecipeById($recept_id);
    $kategorijeRecepta = $rs->getRecipeCategories($recept_id);
    $sastojciRecepta = $rs->getRecipeIngridients($recept_id);
    $popisKorisnika = $rs->getAllUsers();
    $komentariRecepta = $rs->getRecipeComments($recept_id);
    $prosjecnaOcjena = $rs->getAverageRating($recept_id);
    $omiljeni = $rs->getMyFavourites();
    $prijedlog_recepta = $rs->getRecommendations($recept_id);
    require_once __DIR__ . '/../view/prikazi_recept.php';
  }

}

 ?>
