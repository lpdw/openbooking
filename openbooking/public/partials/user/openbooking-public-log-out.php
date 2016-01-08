<?php
session_start();

if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {


  if(isset($_SESSION['openbooking_user']))
  {
      unset($_SESSION['openbooking_user']);

 }

} else {
    die;
}
