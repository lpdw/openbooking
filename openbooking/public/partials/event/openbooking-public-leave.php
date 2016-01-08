<?php
session_start();
require_once (dirname(__FILE__). '/../../../openbooking-api/autoload.php');
use OpenBooking\_Class\Metier\Participant;
use OpenBooking\_Class\Metier\Event;
use OpenBooking\_Class\Metier\Participation;


if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {


  if(isset($_SESSION['openbooking_user']))
  {
      try{
          $user = new Participant($_SESSION['openbooking_user']['email'], $_SESSION['openbooking_user']['password']);
          $event = new Event($_POST["event_id"]);
          //Participation::add($user->get(), $event);
      } catch(Exception $e){
          $error = "Oops, une erreur est survenue. Merci de réessayer ultérieurement";
      }
  }

}  else {
    die;
}
