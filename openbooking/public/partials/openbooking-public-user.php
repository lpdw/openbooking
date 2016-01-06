<?php

class Openbooking_PublicUser
{

  /**
	 * The ID of the user.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      int    $user_id    The ID of the user.
	 */
	private $user_id;

  public function __construct()
  {
    session_start();
    if(isset($_SESSION['id']))
    {
      $user_id == $_SESSION['id'];
    } else {
      $user_id == '7';
    }
  }





}
