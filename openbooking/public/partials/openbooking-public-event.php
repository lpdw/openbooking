<?php
session_start();


use OpenBooking\_Class\Metier\Participant;
use OpenBooking\_Class\Metier\Participation;
use OpenBooking\_Class\Metier\Event;
use OpenBooking\_Exceptions\LoginException;

class Openbooking_Public_Event
{
    public function __construct()
    {
        add_shortcode('openbooking_show_event', array($this, 'show_event_html'));
      	add_shortcode('openbooking_list_events', array($this, 'list_events_html'));
    }

    public function show_event_html($atts, $content)
    {
        $html = array();

        $atts = shortcode_atts(array('template' => 'Default'), $atts);


        if (isset($atts['id']))
        {
            try {
                $event = new Event($atts['id']);
            } catch (\OpenBooking\_Exceptions\UnknowErrorException $e) {
                $error = "Unknown Event";
            } catch (\OpenBooking\_Exceptions\SQLErrorException $e) {
                $error = "SQL";
            }

        } else if (isset($_GET['event_id']))
        {
            try {
                $event = new Event($_GET['event_id']);
            } catch (\OpenBooking\_Exceptions\UnknowErrorException $e) {
                $error = "Unknown Event";
            } catch (\OpenBooking\_Exceptions\SQLErrorException $e) {
                $error = "SQL";
            }
        }

        if (isset($event)&&!isset($error))
        {
            if(isset($_SESSION['openbooking_user']))
            {

                $user = new Participant($_SESSION['openbooking_user']['email'], $_SESSION['openbooking_user']['password']);

                try {
                    $participation = new Participation($user, $event);
                    if($participation->getId() == 0 ){
                        throw new Exception("");
                    } else {
                        $participation_to_this_event = true;
                    }
                } catch (Exception $e) {
                    $participation_to_this_event = false;
                }
            }
            $html[] = ' <input type="hidden" id="plugin_dir_url" value="'. plugin_dir_url(__FILE__).'"/>';


            if(file_exists(plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/show-event.php'))
            {
                include plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/show-event.php';

                if(file_exists(plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/css/show-event.css'))
                {
//            include_once plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/css/show-event.css';

                    wp_enqueue_style( 'openbooking-templates-'.$atts['template'].'-show-event', plugin_dir_url( __FILE__ ).'templates/'.$atts['template'].'/css/show-event.css', array(), $this->version, 'all' );
                } else if (file_exists(plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/css/'.$atts['template'].'.css'));
            } else {
                $html[] = "<h1> The template doesn't exist. </h1>";
            }
        }else if (isset($error)){
            $html[] = "<h1>".$error."</h1>";
        } else {
            $html[] = "<h1> No Event to display</h1>";
        }



    echo implode('', $html);
  }

  public function list_events_html($atts, $content)
	{
	$atts = shortcode_atts(array('template' => 'Default'), $atts);

    $events = Event::getAll();


	$html = array();

      if(file_exists(plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/list-events.php'))
      {
        include plugin_dir_path(__FILE__).'templates/'.$atts['template'].'/list-events.php';
      } else {
        $html[] = "<h1> The template doesn't exist. </h1>";
      }

	echo implode('', $html);
	}


}
?>