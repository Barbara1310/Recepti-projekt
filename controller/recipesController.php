<?php
require_once __DIR__ . '/../model/recipesservice.class.php';

class recipesController
{
  public function index() //defaultna stranica - ovdje se svaki dan prikazuju random recepti iz 3 kategorije
    {
      $title= $_SESSION['username'] . ', što ti se danas kuha?';
      $rs=new RecipesService();

      
      require_once __DIR__ . '/../view/naslovna.php';

    }

  public function recepti() //ovdje će se pokazivati svi recepti ulogiranog autora
    {
      $title='Moji recepti';
      

      

    }  

  public function favoriti() //ovdje će se pokazivati svi favoriti ulogiranog autora
    {
      $title='Moji favoriti';
      

      

    }
    
  public function pretraga() //ovdje će se pretraživati svi recepti
    {
      $title='Pretraži recepte';
     

      

    }
    
  public function dodaj() //ovdje će se dodavati novi recepti
    {
      $title='Novi recept';
     

      

    }   
  
    

}

 ?>
