<?php

 $html[] = '<div class="event_list_header">';
if(isset($_SESSION['openbooking_user']))
  {
  $html[] = '<p> '.$_SESSION['openbooking_user']['email'].' <button class="event_log_out"> Se Déconnecter </button> </p>';
  }
$html[] = '</div>';

$html[] = '<ul class="event_list_content">';
foreach ($events as $event)
{
  $html[] = '<li class="event_list_element">';

  $html[] = '<div class="element_header">';
  $html[] = '<h4 class="event_name">'.$event->name.'</h4>';
  $html[] = '<p class="event_information"> Organizer: <a href="mailto:'.$event->organizer_email.'"> '.$event->organizer.' </a> <br/>
  Date: '.$event->date.'</p>';
  $html[] = '</div>';

  $html[] = '<div class="element_content">';
  $html[] = "<script>
  var map_list_event_".$event->id.";
  function initialize_map_list_element_".$event->id."() {
    map_list_event_".$event->id." = new google.maps.Map(document.getElementById('event_map_list_element_".$event->id."'), {
      center: {lat: 46.2276380, lng: 2.2137490},
      zoom: 2
    });

    // Search for our location name.
    var request_".$event->id." = {
      query: '".$event->localisation."'
    };


    var service = new google.maps.places.PlacesService(map_list_event_".$event->id.");
    service.textSearch(request_".$event->id.", callback_list_event_".$event->id.");

  }

  // Checks that the PlacesServiceStatus is OK, and adds a marker
  // using the place ID and location from the PlacesService.
  function callback_list_event_".$event->id."(results, status) {
    // We check if Google know the place
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      // If a place is found
      map_list_event_".$event->id.".setCenter(results[0].geometry.location);
      map_list_event_".$event->id.".setZoom(18);
      var marker = new google.maps.Marker({
        map: map_list_event_".$event->id.",
        place: {
          placeId: results[0].place_id,
          location: results[0].geometry.location
        }
      });
    }
  }

  google.maps.event.addDomListener(window, 'load', initialize_map_list_element_".$event->id.");</script>";

  $html[] = '<div id="event_map_list_element_'.$event->id.'" style="height:100px;"></div>';
  $html[] = '<p class="event_description">'.$event->description.'</p>';
  $html[] = '<a href="'.site_url().'/event?event_id='.$event->id.'">Voir plus</a>';
//
  $html[] = '</div>';
  $html[] = '</li>';
  $html[] = '<hr/>';
}
$html[] = '</ul>';
$html[] = '<div class="event_list_footer">';
$html[] = '</div>';

