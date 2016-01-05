<?php
class Openbooking_ShowEvent
{
    public function __construct()
    {
        add_shortcode('openbooking_show_event', array($this, 'show_event_html'));
    }

    public function show_event_html($atts, $content)
    {
    $atts = shortcode_atts(array('numberposts' => 5, 'order' => 'DESC'), $atts);
    //$posts = get_posts($atts);
    $event = array('event_title' => 'Initiation Domotique', 'event_description' => 'Initiation à la domotique', 'event_organisator_id' => '1', 'event_adress' => '2 rue de l etoile 93000 Gennevillier', 'event_date' => '2016-01-04 15:00:00');


    $html = array();
    $html[] = $content;
    $html[] = '<div>';
    $html[] = '<h1>'.$event['event_title'].'</h1>';
    $html[] = '<h2>'.$event['event_description'].'</h2>';
    $html[] = '</div>';

    echo implode('', $html);
  }
}
