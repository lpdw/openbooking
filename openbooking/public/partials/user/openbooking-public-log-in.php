<?php
  session_start();

if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {


  if(!isset($_SESSION['id']))
  {
    if(isset($_POST['email'])&&isset($_POST['password']))
    {
      $email = test_input($_POST['email']);
      $password = test_input($_POST['password']);

      if($email=="" || $password=="")
      {
        echo $email.' email';
        echo $password.' password';
        echo 'Merci de vérifier tous les champs avant de soumettre le formulaire. A';
      } else {
        // if(connect($login,$password)){
        //   $_SESSION['mail'] = $login;
        //   echo 'Votre compte vient dêtre crée !';
        // } else {
        //   echo 'Mauvais identifiants !';
        // }

          $_SESSION['id']         = '1';
          $_SESSION['email']      = $email;
          $_SESSION['first_name'] = 'Matthieu';
          $_SESSION['last_name']  = 'Test';

           echo 'Votre compte vient dêtre crée !';
      }
    } else {
      echo 'Merci de vérifier tous les champs avant de soumettre le formulaire. T';
    }
  }
} else {
  header ("Location: $_SERVER[HTTP_REFERER]" );
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
