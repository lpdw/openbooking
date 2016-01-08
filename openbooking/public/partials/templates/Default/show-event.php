<?php

$html[] = '<div id="event_'.$event->getid().'" class="event">';
$html[] = '<div class="event_header">';

if(isset($_SESSION['openbooking_user']))
{
$html[] = '<p> Connected as '.$_SESSION['openbooking_user']['email'].' <button class="event_log_out"> Se Déconnecter </button> </p>';
}

$html[] = '<h4 class="event_name">'.$event->getname().'</h4>';
$html[] = '<p class="event_information"> Organizer: <a href="mailto:'.$event->getorganizeremail().'"> '.$event->getorganizer().' </a> <br/>
Location: '.$event->getlocalisation().'<br/>
Date: '.$event->getdate().'</p>';
$html[] = '</div>';

$html[] = '<div class="event_content">';
$html[] = '<p class="event_description">'.$event->getdescription().'</p>';
$html[] = $content;
$html[] = "<script>
var map_".$event->getid()." ;
function initialize_map_".$event->getid()."() {
  map_".$event->getid()." = new google.maps.Map(document.getElementById('event_map_".$event->getid()."'), {
    center: {lat: 46.2276380, lng: 2.2137490},
    zoom: 2
  });

  // Search for our location name.
  var request_".$event->getid()." = {
    query: '".$event->getlocalisation()."'
  };

  var service = new google.maps.places.PlacesService(map_".$event->getid().");
  service.textSearch(request_".$event->getid().", callback);

}

// Checks that the PlacesServiceStatus is OK, and adds a marker
// using the place ID and location from the PlacesService.
function callback(results, status) {
  // We check if Google know the place
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    // If a place is found
    map_".$event->getid().".setCenter(results[0].geometry.location);
    map_".$event->getid().".setZoom(18);
    var marker = new google.maps.Marker({
      map: map_".$event->getid().",
      place: {
        placeId: results[0].place_id,
        location: results[0].geometry.location
      }
    });
  } else {
    // if not we check for a physical address
     }
}

google.maps.event.addDomListener(window, 'load', initialize_map_".$event->getid().");</script>";
$html[] = '<div id="event_map_'.$event->getid().'" style="height:200px;"></div>';
$html[] = '</div>';

$html[] = '<div class="event_footer">';

  if(isset($_SESSION['openbooking_user'])){
    if(isset($participation_to_this_event) && $participation_to_this_event ){
      $html[] = '<p>You are participating to this event.</p>';
      $html[] = '<div class="more">';
      $html[] = '<p> Are you sure you wanna leave this event ? </p>';
      $html[] = '<button class="btn_cancel"> No </button>';
      $html[] = '<button class="event_leave"> Yes </button>';
      $html[] = '</div>';
      $html[] = '<button class="event_leave" data-event="'.$event->getId().'"> Leave </button>';
    } else {
      $html[] = '<button class="event_join" data-event="'.$event->getId().'"> Join </button>';
      }

  } else {
    $html[] = '<div class="sign-in">';
    $html[] = '<div class="more">';
    $html[] = '<form onsubmit="return false;">';
    $html[] = '<div class="event_server_message"></div>';

    $html[] = '<label for="event_first_name_'.$event->getid().'"> Firstname: </label>';
    $html[] = '<input id="event_first_name_'.$event->getid().'" class="first_name" name="first_name" type="text" placeholder="Firstname"/>';

    $html[] = '<label for="event_last_name_'.$event->getid().'"> Lastname: </label>';
    $html[] = '<input id="event_last_name_'.$event->getid().'" class="last_name" name="last_name" type="text" placeholder="Lastname"/>';

    $html[] = '<label for="event_email_'.$event->getid().'"> Email: </label>';
    $html[] = '<input id="event_email_'.$event->getid().'" class="email" name="login" type="email" placeholder="Email"/>';

    $html[] = '<label for="event_password1_'.$event->getid().'"> Password: </label>';
    $html[] = '<input id="event_password1_'.$event->getid().'" class="password1" name="password1" type="password" placeholder="Password"/>';

    $html[] = '<label for="event_password2_'.$event->getid().'"> Your password again: </label>';
    $html[] = '<input id="event_password2_'.$event->getid().'" class="password2" name="password2" type="password" placeholder="Password"/>';

    $html[] = '<button class="btn_cancel"> Close </button>';
    $html[] = '<button class="event_sign_in"> Sign in </button>';

    $html[] = '</form>';
    $html[] = '</div>';
    $html[] = '<button class="btn_change"> Sign in </button>';
    $html[] = '</div>';

    $html[] = '<div class="log-in">';
    $html[] = '<div class="more">';
    $html[] = '<form onsubmit="return false;">';
    $html[] = '<div class="event_server_message"></div>';

    $html[] = '<label for="event_email_log_'.$event->getid().'"> Email: </label>';
    $html[] = '<input id="event_email_log_'.$event->getid().'" class="email" name="email_log" type="email" placeholder="Email"/>';

    $html[] = '<label for="event_password_'.$event->getid().'"> Password: </label>';
    $html[] = '<input id="event_password_'.$event->getid().'" class="password" name="password" type="password" placeholder="password"/>';

    $html[] = '<button class="btn_cancel"> Close </button>';
    $html[] = '<button class="event_log_in"> Log in </button>';

    $html[] = '</form>';
    $html[] = '</div>';
    $html[] = '<button class="btn_change"> Log in </button>';
    $html[] = '</div>';
  }

$html[] = '</div>';

$html[] = '</div>';

?>
