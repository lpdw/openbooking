<?php
  session_start();

if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {


  if(isset($_SESSION['mail']))
  {

   //function to leave event

   echo 'Vous vous êtes désincrit de cet événement !';

 }

} else {
  header ("Location: $_SERVER[HTTP_REFERER]" );
}
