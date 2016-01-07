<?php
  session_start();

if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {


  if(!isset($_SESSION['id']))
  {
    if(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['email'])&&isset($_POST['password_first'])&&isset($_POST['password_second']))
    {
      $first_name = test_input($_POST['first_name']);
      $last_name = test_input($_POST['last_name']);
      $email = test_input($_POST['email']);
      $password_first = test_input($_POST['password_first']);
      $password_second = test_input($_POST['password_second']);

      if($first_name=="" || $last_name=="" || $email=="" || $password_first=="" || $password_second=="" || ($password_first!==$password_second))
      {
        echo '<div class="event_error">Merci de vérifier tous les champs avant de soumettre le formulaire.</div>';
      } else {
        // if(connect($login,$password)){
        //   $_SESSION['mail'] = $login;
        //   echo 'Votre compte vient dêtre crée !';
        // } else {
        //   echo 'Mauvais identifiants !';
        // }

          $_SESSION['id']         = '1';
          $_SESSION['email']      = $email;
          $_SESSION['first_name'] = $first_name;
          $_SESSION['last_name']  = $last_name;
      }
    } else {
      echo '<div class="event_error">Merci de vérifier tous les champs avant de soumettre le formulaire.</div>';
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
