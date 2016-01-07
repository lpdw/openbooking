<?php
session_start();

class Openbooking_Public_Event
{
    public function __construct()
    {
        add_shortcode('openbooking_show_event', array($this, 'show_event_html'));
      	add_shortcode('openbooking_list_events', array($this, 'list_events_html'));
        
    }

    public function show_event_html($atts, $content)
    {
    $atts = shortcode_atts(array('id' => '1', 'template' => 'Default'), $atts);
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
    'participants_registred'=> 3,
    'participating_to_this_event' => false);

    $html = array();

    if(file_exists(plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/show-event.php'))
    {
      include plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/show-event.php';
    } else {
      $html[] = "<h1> The template doesn't exist. </h1>";
    }

    echo implode('', $html);
  }

  public function list_events_html($atts, $content)
	{
	$atts = shortcode_atts(array('id' => '1', 'template' => 'Default'), $atts);
	//$events = get_events_by_ID($atts);
	$events = array(
		array('id'     => 1,
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
    'participants_registred'=> 3,
		'participating_to_this_event' => false),
		array('id'     => 2,
    'name'                  => 'Initiation Papier Peint',
    'description'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam volutpat consequat mi, non sodales massa laoreet quis. Mauris ac elit vitae orci porta rutrum ac non neque. Aliquam blandit lorem in dictum molestie. Nunc vel ultricies arcu, vitae commodo sem. Phasellus iaculis orci enim, a tempor sem congue eleifend. Vestibulum iaculis porttitor congue. Vivamus ut quam id massa rhoncus vehicula id sit amet orci.',
    'localisation_name'     => 'Tour Eiffel',
    'localisation_lat'      => '48.9358093',
    'localisation_lng'      => '2.3032078',
    'date'                  => '2016-12-24 15:00:00',
    'organizer'             => 'Valérie Damido',
    'organizer_email'       => 'toto@toto.fr',
    'creation_date'         => '2016-01-04 15:00:00',
    'open_to_registration'  => true,
    'cancelled'             => false,
    'participants_max'      => 4,
    'participants_registred'=> 4,
		'participating_to_this_event' => true)
	);

	$html = array();

      if(file_exists(plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/list-event.php'))
      {
        include plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/list-event.php';
      } else {
        $html[] = "<h1> The template doesn't exist. </h1>";
      }

	echo implode('', $html);
	}
}
