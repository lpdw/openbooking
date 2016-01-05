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
    $event = array('id' => 1, 'name' => 'Initiation Domotique',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam volutpat consequat mi, non sodales massa laoreet quis. Mauris ac elit vitae orci porta rutrum ac non neque. Aliquam blandit lorem in dictum molestie. Nunc vel ultricies arcu, vitae commodo sem. Phasellus iaculis orci enim, a tempor sem congue eleifend. Vestibulum iaculis porttitor congue. Vivamus ut quam id massa rhoncus vehicula id sit amet orci.',
    'localisation' => '2 rue de l etoile 93000 Gennevillier',
    'date' => '2016-01-15 15:00:00',
    'organizer' => 'Laurent Ricard', 'organizer_email' => 'toto@toto.fr', 'creation_date' => '2016-01-04 15:00:00', 'open_to_registration' => true, 'cancelled' => false, 'participants_max' => 4, 'participants_registred' => 4);


    $html = array();
    $html[] = '<div class="event">';

    $html[] = '<div class="event_header">';
    $html[] = '<h4 class="event_name">'.$event['name'].'</h4>';
    $html[] = '<p class="event_information"> Organisateur: <a href="mailto:'.$event['organizer_email'].'"> '.$event['organizer'].' </a> <br/>
    Adresse: '.$event['localisation'].'<br/>
    Date: '.$event['date'].'</p>';
    $html[] = '</div>';

    $html[] = '<div class="event_content">';
    $html[] = '<p class="event_description">'.$event['description'].'</p>';
    $html[] = $content;
    $html[] = '</div>';

    $html[] = '<div class="event_footer">';
    if($event['open_to_registration'] && !$event['cancelled'])
    {
      if($event['participants_registred'] < $event['participants_max'])
      {
        $html[] = '<a href="'.$event['id'].'"> Participer </a>';
      } else {
        $html[] = '<p> Toutes les places sont prises, cependant vous pouvez être alerté dès qu une place se libère ! </p>';
        $html[] = '<a href="'.$event['id'].'"> Être alerté </a>';
      }
    } elseif ($event['cancelled'])
    {
      $html[] = '<p> Evenement annulé </p>';
    } elseif (!$event['open_to_registration'])
    {
      $html[] = '<p> Inscriptions fermées </p>';
    }
    $html[] = '</div>';

    $html[] = '</div>';


    echo implode('', $html);
  }
}
