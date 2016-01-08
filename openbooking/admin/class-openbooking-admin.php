<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.lp-dw.com/
 * @since      1.0.0
 *
 * @package    Openbooking
 * @subpackage Openbooking/admin
 */

use OpenBooking\_Class\Metier\Participant;
use OpenBooking\_Class\Metier\Event;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Openbooking
 * @subpackage Openbooking/admin
 * @author     LPDW <preprod-openbooking@epoulain.fr>
 */
class Openbooking_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * All participants.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $version    The current version of this plugin.
	 */
	public $participants_obj;

	/**
	 * All events.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $version    The current version of this plugin.
	 */
	public $events_obj;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Openbooking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Openbooking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/openbooking-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Openbooking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Openbooking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'vendor/modernizr-custom.min.js', array( 'jquery' ), '3.2.0', false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/openbooking-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register admin menu items.
	 *
	 * @since   1.0.0
	 */
	public function register_menu() {

		// Main menu page
		add_menu_page(
			__( 'Openbooking', $this->plugin_name ),
			__( 'Openbooking', $this->plugin_name ),
			'edit_pages',
			'openbooking',
			array( $this, 'display_admin_page' ),
			'dashicons-calendar-alt'
		);

		// Events page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Events', $this->plugin_name ),
			__( 'Manage Events', $this->plugin_name ),
			'manage_options',
			'openbooking-events',
			array( $this, 'display_events_page' )
		);

		// Add Event page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Add Event', $this->plugin_name ),
			__( 'New Event', $this->plugin_name ),
			'manage_options',
			'openbooking-new-event',
			array( $this, 'display_new_event_page' )
		);

		// Participants page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Participants', $this->plugin_name ),
			__( 'Manage Participants', $this->plugin_name ),
			'manage_options',
			'openbooking-participants',
			array( $this, 'display_participants_page' )
		);

		// Add Participant page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Add Participant', $this->plugin_name ),
			__( 'New Participant', $this->plugin_name ),
			'manage_options',
			'openbooking-new-participant',
			array( $this, 'display_new_participant_page' )
		);

		// Newsletter page
		/*add_submenu_page(
			'openbooking',
			__( 'Openbooking Newsletter/Reminder', $this->plugin_name ),
			__( 'Newsletter', $this->plugin_name ),
			'edit_pages',
			'openbooking-newsletter',
			array( $this, 'display_newsletter_page' )
		);*/

		// Options page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Options', $this->plugin_name ),
			__( 'Options', $this->plugin_name ),
			'manage_options',
			'staff-participant-options',
			array( $this, 'display_options_page' )
		);

	}

	/**
	 * Display main admin page content.
	 *
	 * @since   1.0.0
	 */
	public function display_admin_page() {
		include_once( 'partials/openbooking-admin-display.php' );
	}

	/**
	 * Display Participants page content.
	 *
	 * @since   1.0.0
	 */
	public function display_participants_page() {
		include_once (WP_PLUGIN_DIR . '/openbooking/openbooking-api/_class/metier/Participant.php');
		include_once('partials/openbooking-participants-class.php');

		//add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		$this->participants_obj = new obParticipantsTable();

		include_once('partials/openbooking-participants-display.php');
	}

	/**
	 * Display New Participant page content.
	 *
	 * @since   1.0.0
	 */
	public function display_new_participant_page() {
		include_once (WP_PLUGIN_DIR . '/openbooking/openbooking-api/_class/metier/Participant.php');

		include_once( 'partials/openbooking-new-participant-display.php' );
	}

	/**
	 * Display Events page content.
	 *
	 * @since   1.0.0
	 */
	public function display_events_page() {
		include_once (WP_PLUGIN_DIR . '/openbooking/openbooking-api/_class/metier/Event.php');
		include_once('partials/openbooking-events-class.php');

		//add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		$this->events_obj = new obEventsTable();

		include_once( 'partials/openbooking-events-display.php' );
	}

	/**
	 * Display New Event page content.
	 *
	 * @since   1.0.0
	 */
	public function display_new_event_page() {
		include_once (WP_PLUGIN_DIR . '/openbooking/openbooking-api/_class/metier/Event.php');

		include_once( 'partials/openbooking-new-event-display.php' );
	}

	/**
	 * Hook for adding/editing new post (event or participant).
	 *
	 * @since   1.0.0
	 */
	public function custom_post_submit()
	{
		include_once(WP_PLUGIN_DIR . '/openbooking/openbooking-api/_class/metier/Event.php');
		include_once(WP_PLUGIN_DIR . '/openbooking/openbooking-api/_class/metier/Participant.php');

		if (!function_exists('publish_event')){
			function publish_event(){
				$event = array(
					'type' => $_REQUEST['type'],
					'publish' => $_REQUEST['publish'],
					'open_to_registration' => $_REQUEST['open_to_registration'],
					'name' => $_REQUEST['name'],
					'date' => $_REQUEST['date'],
					'localisation' => $_REQUEST['localisation'],
					'participants_max' => $_REQUEST['participants_max'],
					'organizer' => $_REQUEST['organizer'],
					'organizer_email' => $_REQUEST['organizer_email'],
					'description' => $_REQUEST['description']
				);

				Event::add($event['name'], $event['description'], $event['localisation'], $event['date'], $event['participants_max'], $event['organizer'], $event['organizer_email'], $event['open_to_registration']);

				wp_redirect(admin_url('admin.php?page=openbooking-new-event&success=addok'));
			}
		}

		if (!function_exists('publish_participant')){

			if (!function_exists('publish_participant')){
				function publish_participant(){
					$participant = array(
						'type' => $_REQUEST['type'],
						'publish' => $_REQUEST['publish'],
						'first_name' => $_REQUEST['first_name'],
						'last_name' => $_REQUEST['last_name'],
						'email' => $_REQUEST['email'],
						'password' => $_REQUEST['password']
					);

					Participant::add($participant['first_name'],$participant['last_name'],$participant['email'],$participant['password']);

					wp_redirect(admin_url('admin.php?page=openbooking-new-participant&success=addok'));
				}
			}

		}

		if (!function_exists('save_event')){
			function save_event() {
				$event = array(
					'type' => $_REQUEST['type'],
					'id' => $_REQUEST['id'],
					'save' => $_REQUEST['save'],
					'open_to_registration' => $_REQUEST['open_to_registration'],
					'name' => $_REQUEST['name'],
					'date' => $_REQUEST['date'],
					'localisation' => $_REQUEST['localisation'],
					'participants_max' => $_REQUEST['participants_max'],
					'organizer' => $_REQUEST['organizer'],
					'organizer_email' => $_REQUEST['organizer_email'],
					'description' => $_REQUEST['description']
				);

				$event_obj = new Event($event['id']);
				$event_obj->update($event['name'], $event['description'], $event['localisation'], $event['date'], $event['participants_max'], $event['organizer'], $event['organizer_email'], $event['open_to_registration']);

				wp_redirect(admin_url('admin.php?page=openbooking-new-event&action=edit&id='.$event['id'].'&success=updateok'));
			}
		}

		if (!function_exists('save_participant')) {
			//TODO : edit participant
		}

		if (isset($_REQUEST['publish'])) {

			if ($_GET['type']=='event'){
				publish_event();
			} elseif($_GET['type']=='participant') {
				publish_participant();
			} else {
				$request = print_r($_REQUEST);
				die ("Error : $request");
			}

		} elseif (isset($_REQUEST['save'])) {

			if ($_GET['type']=='event') {
				save_event();
			} elseif($_GET['type']=='participant') {

			} else {
				$request = print_r($_REQUEST);
				die ("Error : $request");
			}

		} else {
			$request = print_r($_REQUEST);
			die ("Error : $request");
		}
	}

	/**
	 * Display Newsletter page content.
	 *
	 * @since   1.0.0
	 */
	public function display_newsletter_page() {
		include_once( 'partials/openbooking-newsletter-display.php' );
	}

	/**
	 * Display Options page content.
	 *
	 * @since   1.0.0
	 */
	public function display_options_page() {
		include_once( 'partials/openbooking-options-display.php' );
	}

}
