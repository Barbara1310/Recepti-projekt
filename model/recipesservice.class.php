<?php
session_start();
require_once __DIR__ . '/../app/db.class.php';
require_once __DIR__ . '/recipe.class.php';
require_once __DIR__ . '/category.class.php';

class RecipesService{


  public function isUserInBase( $username, $password ) //funckija koja provjerava je li korisnik koji se pokušava ulogirati u bazi
  {
    $db = DB::getConnection();

    try{
       $st = $db->prepare( 'SELECT password_hash FROM p_users WHERE username=:username' );
       $st->execute( ['username' => $username] );
   }catch( PDOException $e ){echo $e->getMessage();}
   $row = $st->fetch();
   if( $row === false ){
       return false;
   }
   else{
       $hash = $row['password_hash'];
       if( password_verify( $_POST['password'], $hash ) ){
           return true;
       }
       else return false;
    }
   }


  // funkcija koja provjerava postoji li neki username u bazi
  public function isUsernameInBase( $username )
  {
    $db = DB::getConnection();

    try{
       $st = $db->prepare( 'SELECT username FROM p_users WHERE username=:username' );
       $st->execute( ['username' => $username] );
   }catch( PDOException $e ){echo $e->getMessage();}
   $row = $st->fetch();
   if( $row === false ){
       return false;
   }
   else{
        return true;
    }
   }

  // funkcija koja provjerava postoji li neki email u bazi
  public function isEmailInBase( $email )
  {
    $db = DB::getConnection();

    try{
       $st = $db->prepare( 'SELECT email FROM p_users WHERE email=:email' );
       $st->execute( ['email' => $email] );
   }catch( PDOException $e ){echo $e->getMessage();}
   $row = $st->fetch();
   if( $row === false ){
       return false;
   }
   else{
        return true;
    }
   }

// funkcija koja dodaje novog korisnika u bazu
  public function insertUserToBase( $username, $password, $email )
  {
    $db = DB::getConnection();

    try{
       $st = $db->prepare('INSERT INTO p_users(username, password_hash, email, has_registered, registration_sequence, is_admin) VALUES (:username, :password, :email, \'1\', \'abc\', \'0\')');
           $st->execute(array('username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'email' => $email));

   }catch( PDOException $e ){echo $e->getMessage();}
   $row = $st->rowCount();
   if( $row === 0 ){
        echo 'greskaaaa ';
        echo $username . ' ' . $password . ' ' . $email;
       return false;
   }
   else{
        return true;
    }
   }

   public function setUserId( $username ){//fja koja uzima id od korisnika iz baze i ubaci ga u session
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT id FROM p_users WHERE username=:username' );
        $st->execute( ['username' => $username] );
        $id_user = $st->fetch()['id'];
        $_SESSION['id_user'] = $id_user; //postavi se id u session

        $db = DB::getConnection(); //ovdje će se postavit is_admin u session da znamo je li trenutni korisnik admin
        $st = $db->prepare( 'SELECT is_admin FROM p_users WHERE username=:username' );
        $st->execute( ['username' => $username] );
        $is_admin = $st->fetch()['is_admin'];
        $_SESSION['is_admin'] = $is_admin;

    }

    public function triKategorije() //tu ćemo spremit tri različite kategorije
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT DISTINCT id_category FROM p_categories' );


    }

    public function getTodayRecipes() //vraća polje koje sadrži id-jeve današnjih recepata
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM p_recepti_dana' );
        $st->execute();
        $današnji=[];
        while($row = $st-> fetch())
        {
            $današnji[]=$row['id_recipe'];
        }
        return $današnji;
    }
    public function getRecipeById( $id ) //dohvaćanje recepta pomoću id-ja
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM p_recipes WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new Recipe( $row['id'], $row['title'], $row['description'] , $row['link'], $row['duration'], $row['id_user']);
	}

   public function getRecipeByUserId( $id_user ) //dohvaćanje recepata iz baze čiji je autor koristin s id-jem $id_user
   {
     $niz = [];
     try
 		{
 			$db = DB::getConnection();
 			$st = $db->prepare( 'SELECT * FROM p_recipes WHERE id_user = :id_user' );
 			$st->execute( array( 'id_user' => $id_user ) );
 		}
 		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    while( $row = $st->fetch() ){
           $niz[] = new Recipe( $row['id'], $row['title'], $row['description'], $row['link'], $row['duration'], $row['id_user'] );
       }
       return $niz;

   }

   public function getMyFavourites() //dohvaćanje favorita ulogirane osobe
   {
     $favoriti = [];
     $recepti = [];
     $id_user = $_SESSION['id_user'];
     $db = DB::getConnection();
     $st = $db->prepare('SELECT * FROM p_favourites WHERE id_user=:id_user');
     $st->execute( ['id_user' => $id_user] );
     while( $row = $st->fetch() )
          $favoriti[] =  $row['id_recipe'];
    //sada imamo id-jeve od recepata koji su favoriti

    for($i = 0; $i < count($favoriti); $i++) //za svaki id recepta izvlačimo recepte
    {
      try
  		{
  			$db = DB::getConnection();
  			$st = $db->prepare( 'SELECT * FROM p_recipes WHERE id=:id' );
  			$st->execute( array( 'id' => $favoriti[$i] ) );
  		}
      	catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();
        if( $row === false )
    			{//nista ne radi
          }
    	  else $recepti[] = new Recipe( $row['id'], $row['title'], $row['description'] , $row['link'], $row['duration'], $row['id_user']);
    }
    if(!empty($recepti))
      return $recepti;
    else return NULL;

   }

   public function createNewRecipe($title, $description, $link, $duration, $id_user) //stvaranje novog recepta u bazi
   {
       $db = DB::getConnection();
        $st = $db->prepare( "INSERT INTO p_recipes (id, title, description, link, duration, id_user)
                                VALUES (NULL, :title, :description, :link, :duration, :id_user)" );


        $st->bindParam(':title', $title);
        $st->bindParam(':description', $description);
        $st->bindParam(':link', $link);
        $st->bindParam(':duration', $duration);
        $st->bindParam(':id_user', $id_user);
        $st->execute();

   }
   public function getRecipeIdByLink($link) //dohvaćanje recepta preko linka
   {
      $db = DB::getConnection();
      $st = $db->prepare( 'SELECT id FROM p_recipes WHERE link=:link' );
      $st->execute( ['link' => $link] );
      $id_recipe = $st->fetch()['id'];

      return $id_recipe;

   }
   public function insertIngredient($id_recipe, $amount, $ingredient) //ubacuje sastojke i količinu u bazu p_recipes_ingredients
   {
      $db = DB::getConnection();
      $st = $db->prepare( "INSERT INTO p_recipes_ingredients (id, id_recipe, amount, ingredient)
                              VALUES (NULL, :id_recipe, :amount, :ingredient)" );


      $st->bindParam(':id_recipe', $id_recipe);
      $st->bindParam(':amount', $amount);
      $st->bindParam(':ingredient', $ingredient);
      $st->execute();

   }
   public function getAllCategories(){
       $categories = [];
       $db = DB::getConnection();
       $st = $db->prepare( 'SELECT id, name FROM p_categories' );
       $st->execute();

       while( $row = $st->fetch() ){
           array_push($categories, new Category( $row['id'], $row['name']));
       }
       return $categories;
   }
   public function insertCategorysOfRecipe($id_recipe, $id_category)
   {
     $db = DB::getConnection();
     $st = $db->prepare( "INSERT INTO p_recipes_categories (id, id_recipe, id_category)
                             VALUES (NULL, :id_recipe, :id_category)" );


     $st->bindParam(':id_recipe', $id_recipe);
     $st->bindParam(':id_category', $id_category);
     $st->execute();

   }

   public function addNewCategory($name)
   {
     $db = DB::getConnection();
     $st = $db->prepare( "INSERT INTO p_categories (id, name)
                             VALUES (NULL, :name)" );


     $st->bindParam(':name', $name);
     $st->execute();

   }


}

 ?>
