<?php
  session_start();

if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {


  if(isset($_SESSION['id']))
  {

   $_SESSION = array();

   session_destroy();

   echo 'Vous êtes déconnectés !';

 }
 
} else {
  header ("Location: $_SERVER[HTTP_REFERER]" );
}
