<?php
require_once __DIR__ . '/../model/recipesservice.class.php';
require_once __DIR__ . '/recipesController.php';

class UsersController{
  //funkcija koja nam daje login screen
  public function login()
  {
    require_once __DIR__.'/../view/login.php';
  }
  //funkcija koja obrađuje prijavu korisnika
  public function handleLogin()
  {
    if( isset($_POST['username']) && preg_match('/^[A-ža-ž0-9_-]+$/', $_POST['username']) && isset($_POST['password']) )
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $rs = new RecipesService;
      

      if($rs->isUserInBase($username, $password)) //provjera je li korisnik u bazi, ako je, stavimo u session
      {
        $_SESSION['username'] = $_POST['username']; //zelimo jos u session ubaciti i id korisnika
        $rs->setUserId( $username ); //ta fja nam vadi id korisnika iz baze i ubaci ga u session
        header('Location: recipes.php?rt=recipes/index'); //idi na recipesController i index fju
      	
      }
      else {
        require_once __DIR__ . '/../view/login.php';
        echo '<br>';
        echo '<span style = "font-family: Verdana, Geneva, sans-serif; color: #00008B;">' . 'Unesite ispravne podatke za prijavu.' . '</span>';       
      }

    }

  }

//funkcija koja obrađuje registraciju korisnika
  public function handleRegistration()
  {
    if( isset($_POST['username']) && preg_match('/^[A-ža-ž0-9_-]+$/', $_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['re-password']))
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $re_password = $_POST['re-password'];
      $rs = new RecipesService;
      
      // podudaraju li se passwordi?
      if($re_password != $password){
        require_once __DIR__ . '/../view/register.php';
        echo '<br>';
        echo '<span style = "font-family: Verdana, Geneva, sans-serif; color: #00008B;">' . 'Passwordi se ne podudaraju.' . '</span>';       
        return;
      }

      // je li username jedinstven?
      if($rs->isUsernameInBase($username)){
        require_once __DIR__ . '/../view/register.php';
        echo '<br>';
        echo '<span style = "font-family: Verdana, Geneva, sans-serif; color: #00008B;">' . 'Username je zauzet.' . '</span>';       
        return;
      } 

      // je li email jedinstven?
      if($rs->isEmailInBase($email)){
        require_once __DIR__ . '/../view/register.php';
        echo '<br>';
        echo '<span style = "font-family: Verdana, Geneva, sans-serif; color: #00008B;">' . 'Email je vec registriran.' . '</span>';       
        return;
      }

      if($rs->insertUserToBase($username, $password, $email)) //provjera je li dodavanje korisnika uspjesno, ako je, dodaje u session
      {
        $_SESSION['username'] = $_POST['username']; //zelimo jos u session ubaciti i id korisnika
        $rs->setUserId( $username ); //ta fja nam vadi id korisnika iz baze i ubaci ga u session
        header('Location: recipes.php?rt=recipes/index'); //idi na recipesController i index fju
      }
      else{
        require_once __DIR__ . '/../view/register.php';
        echo '<br>';
        echo '<span style = "font-family: Verdana, Geneva, sans-serif; color: #00008B;">' . 'Dogodila se greska.' . '</span>';       
        return;
      }

    }

  }


  public function logout(){ //odjava, unisti sesiju i vrati na login
        session_unset();
        session_destroy();
        require_once __DIR__ . '/../view/login.php';
    }


};


 ?>
