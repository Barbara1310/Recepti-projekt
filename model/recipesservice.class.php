<?php
session_start();
require_once __DIR__ . '/../app/db.class.php';

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


}

 ?>
