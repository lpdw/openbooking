<?php
session_start();

require_once (dirname(__FILE__). '/../../../openbooking-api/autoload.php');
use OpenBooking\_Class\Metier\Participant;
use OpenBooking\_Exceptions\DataAlreadyExistInDatabaseException;

if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {


  if(!isset($_SESSION['openbooking_user']))
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

        try{
          Participant::add($first_name, $last_name, $email, $password_first);
        } catch(DataAlreadyExistInDatabaseException $e){
          $error = "Email déjà prise.";
        } catch(Exception $e){
          $error = "Merci de vérifier tous les champs avant de soumettre le formulaire.";
        }

        if (isset($error))
        {
          echo '<div class="event_error">'.$error.'</div>';
        } else {
          $user = new Participant($email, $password_first);
          $_SESSION['openbooking_user'] = array(
              'id' => $user->getId(),
              'email' => $user->getEmail(),
              'password' => $password_first
          );
          //TODO Manière moins crade de stocker les infos user
        }
      }
    } else {
      echo '<div class="event_error">Merci de vérifier tous les champs avant de soumettre le formulaire.</div>';
    }
  }
}  else {
  die;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
