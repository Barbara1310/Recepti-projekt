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
        echo '<script language="javascript">';
        echo 'alert("Unesite ispravne podatke")';
        echo '</script>';     
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
        require_once __DIR__ . '/../view/login.php';
        echo '<script language="javascript">';
        echo 'alert("Passwordi se ne podudaraju")';
        echo '</script>';

        return;
      }

      // je li username jedinstven?
      if($rs->isUsernameInBase($username)){
        require_once __DIR__ . '/../view/login.php';
        echo '<script language="javascript">';
        echo 'alert("Username zauzet")';
        echo '</script>';        
        return;
      } 

      // je li email jedinstven?
      if($rs->isEmailInBase($email)){
        require_once __DIR__ . '/../view/login.php';
        echo '<script language="javascript">';
        echo 'alert("Email je vec registriran")';
        echo '</script>';
                return;
      }

      $activation_code = rand(3000, 8000);
      if($rs->insertUserToBase($username, $password, $email, $activation_code)) //provjera je li dodavanje korisnika uspjesno, ako je, dodaje u session
      {
        $_SESSION['username'] = $_POST['username']; //zelimo jos u session ubaciti i id korisnika
        $rs->setUserId( $username ); //ta fja nam vadi id korisnika iz baze i ubaci ga u session
        
        $activation_link = "https://rp2.studenti.math.hr/~margegi/Recepti-projekt/model/verification.php/?email=". $email . "&activation_code=" . $activation_code;
        echo '<script language="javascript">';
        echo 'alert(".' . $activation_link . '")';
        echo '</script>';
        echo "link koji saljemo je " . $activation_link;
        
        mail('rp.recepti@outlook.com', 'Verifikacija', "Kliknite na link: " . $activation_link);
        header('Location: recipes.php?rt=recipes/index'); //idi na recipesController i index fju
        
      }
      else{
        require_once __DIR__ . '/../view/login.php';
        echo '<script language="javascript">';
        echo 'alert("Greska")';
        echo '</script>';
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
