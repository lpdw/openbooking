<?php
session_start();

require_once (dirname(__FILE__). '/../../../openbooking-api/autoload.php');
use OpenBooking\_Class\Metier\Participant;
use OpenBooking\_Exceptions\LoginException;
use OpenBooking\_Exceptions\AccessDeniedException;


if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {


  if(!isset($_SESSION['openbooking_user']))
  {
    if(isset($_POST['email'])&&isset($_POST['password']))
    {
      $email = test_input($_POST['email']);
      $password = test_input($_POST['password']);

      if($email=="" || $password=="")
      {

        echo '<div class="event_error">Merci de vérifier tous les champs avant de soumettre le formulaire.</div>';
      } else {

          try{
              $user = new Participant($email, $password);
          } catch(LoginException $e){
              $error = "Identifiants introuvable.";
          } catch(AccessDeniedException $e){
              $error = "Vous avez été bannis.";
          } catch(Exception $e){
              $error = "Oups erreur : ".$e->getMessage();
          }

          if (isset($error))
          {
              echo '<div class="event_error">'.$error.'</div>';
          } else {

              $_SESSION['openbooking_user'] = array(
                  'id' => $user->getId(),
                  'email' => $user->getemail(),
                  'password' => $password
              );

              //TODO Manière moins crade de stocker les infos user
          }

      }
    } else {
            echo '<div class="event_error">Merci de vérifier tous les champs avant de soumettre le formulaire.</div>';
    }
  }
} else {
    die;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
