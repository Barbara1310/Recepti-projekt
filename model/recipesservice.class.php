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

   public function setUserId( $username ){//fja koja uzima id od korisnika iz baze i ubaci ga u session
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT id FROM p_users WHERE username=:username' );
        $st->execute( ['username' => $username] );
        $id_user = $st->fetch()['id'];
        $_SESSION['id_user'] = $id_user;
       
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
    public function getRecipeById( $id )
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


    


}

 ?>
