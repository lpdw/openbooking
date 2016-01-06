<?php
class Openbooking_ShowEvent
{
    public function __construct()
    {
        add_shortcode('openbooking_show_event', array($this, 'show_event_html'));
    }

    public function show_event_html($atts, $content)
    {
    $atts = shortcode_atts(array('id' => '1'), $atts);
    //$event = get_event_by_ID($atts);
    $event = array('id'     => 1,
    'name'                  => 'Initiation Domotique',
    'description'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam volutpat consequat mi, non sodales massa laoreet quis. Mauris ac elit vitae orci porta rutrum ac non neque. Aliquam blandit lorem in dictum molestie. Nunc vel ultricies arcu, vitae commodo sem. Phasellus iaculis orci enim, a tempor sem congue eleifend. Vestibulum iaculis porttitor congue. Vivamus ut quam id massa rhoncus vehicula id sit amet orci.',
    'localisation_name'     => 'FacLab',
    'localisation_lat'      => '48.9358093',
    'localisation_lng'      => '2.3032078',
    'date'                  => '2016-01-15 15:00:00',
    'organizer'             => 'Laurent Ricard',
    'organizer_email'       => 'toto@toto.fr',
    'creation_date'         => '2016-01-04 15:00:00',
    'open_to_registration'  => true,
    'cancelled'             => false,
    'participants_max'      => 4,
    'participants_registred'=> 4);


    $html = array();
    $html[] = '<div class="event">';

    $html[] = '<div class="event_header">';
    $html[] = '<h4 class="event_name">'.$event['name'].'</h4>';
    $html[] = '<p class="event_information"> Organizer: <a href="mailto:'.$event['organizer_email'].'"> '.$event['organizer'].' </a> <br/>
    Address: '.$event['localisation_name'].'<br/>
    Date: '.$event['date'].'</p>';
    $html[] = '</div>';

    $html[] = '<div class="event_content">';
    $html[] = '<p class="event_description">'.$event['description'].'</p>';
    $html[] = $content;
    $html[] = '<div id="event_map_'.$event['id'].'" style="height:200px;"></div>';
    $html[] = '</div>';

    $html[] = '<div class="event_footer">';
    if($event['open_to_registration'] && !$event['cancelled'])
    {
      if($event['participants_registred'] < $event['participants_max'])
      {
        $html[] = '<a href="'.$event['id'].'"> Join </a>';
      } else {
        $html[] = '<h3> All seats are taken ! </h3>';
        $html[] = '<a href="'.$event['id'].'"> Be alerted </a>';
      }
    } elseif ($event['cancelled'])
    {
      $html[] = '<p> Event cancelled </p>';
    } elseif (!$event['open_to_registration'])
    {
      $html[] = '<p> Registrations close </p>';
    }
    $html[] = '</div>';

    $html[] = '</div>';


    $geocode_parameter_type   = 'location';
    $geocode_parameter_value  = '{lat: 0,  lng: 0}';

    if($event['localisation_lng'] && $event['localisation_lat']){
      $geocode_parameter_type   = 'location';
      $geocode_parameter_value  = '{lat:'.$event['localisation_lat'].', lng:'.$event['localisation_lng'].'}';
    } else if ($event['localisation_name'])
    {
      $geocode_parameter_type   = 'address';
      $geocode_parameter_value  = "'".$event['localisation_name']."'";
    }

  $js = "
  var map;

  function initialize() {
    // Create a map centered in Pyrmont, Sydney (Australia).
    map = new google.maps.Map(document.getElementById('event_map_".$event['id']."'), {
      center: {lat: 46.2276380, lng: 2.2137490},
      zoom: 2
    });

    // Search for Google's office in Australia.
    var request = {
      query: '".$event['localisation_name']."'
    };

    var service = new google.maps.places.PlacesService(map);
    service.textSearch(request, callback);


  }

  // Checks that the PlacesServiceStatus is OK, and adds a marker
  // using the place ID and location from the PlacesService.
  function callback(results, status) {
    // We check if Google know the place
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      // If a place is found
      map.setCenter(results[0].geometry.location);
      map.setZoom(18);
      var marker = new google.maps.Marker({
        map: map,
        place: {
          placeId: results[0].place_id,
          location: results[0].geometry.location
        }
      });
    } else {
      // if not we check for a physical address
      var geocoder = new google.maps.Geocoder();
      geocodeAddress(geocoder, map);
    }
  }

  function geocodeAddress(geocoder, resultsMap) {
  geocoder.geocode({'".$geocode_parameter_type."': ".$geocode_parameter_value."}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      resultsMap.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
  }

google.maps.event.addDomListener(window, 'load', initialize);
";


    $html[] = "<script>".$js."</script>";

    echo implode('', $html);
  }
}
