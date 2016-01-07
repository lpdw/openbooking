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
			__( 'Events', $this->plugin_name ),
			'manage_options',
			'openbooking-events',
			array( $this, 'display_events_page' )
		);

		// Add Event page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Add Event', $this->plugin_name ),
			__( 'Add Event', $this->plugin_name ),
			'manage_options',
			'openbooking-new-event',
			array( $this, 'display_new_event_page' )
		);

		// Participants page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Participants', $this->plugin_name ),
			__( 'Participants', $this->plugin_name ),
			'manage_options',
			'openbooking-participants',
			array( $this, 'display_participants_page' )
		);

		// Add Participant page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Add Participant', $this->plugin_name ),
			__( 'Add Participant', $this->plugin_name ),
			'manage_options',
			'openbooking-new-participant',
			array( $this, 'display_new_participant_page' )
		);

		// Newsletter page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Newsletter/Reminder', $this->plugin_name ),
			__( 'Newsletter', $this->plugin_name ),
			'edit_pages',
			'openbooking-newsletter',
			array( $this, 'display_newsletter_page' )
		);

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

		/* DEV TEST BLOCK TODO : delete me */
		//Participant::add('Toto','MICHEL','michel.toto@gmail.com','password');
		//Participant::add('Gabe','NEWELL','praiselordgaben@gmail.com','password');
		/* DEV TEST BLOCK */

		//add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		$this->participants_obj = new obParticipantsTable();

		include_once('partials/openbooking-participants-display.php');
	}

	/**
	 * Display Events page content.
	 *
	 * @since   1.0.0
	 */
	public function display_events_page() {
		include_once (WP_PLUGIN_DIR . '/openbooking/openbooking-api/_class/metier/Event.php');
		include_once('partials/openbooking-events-class.php');

		//$date1 = new DateTime('2000-01-01');
		//$date2 = new DateTime();
		/* DEV TEST BLOCK TODO : delete me */
		//Event::add('Steam Sales','Praise Lord Gaben, Steam Sales are coming ! Shut up and get my money ! Spaces go with ionic cannon! This devastation has only been invaded by a harmless starship. The phenomenan is more parasite now than star. unrelated and impressively delighted.','France','2000-01-01',22,'Gabe Newell','lordgaben@gmail.com',true);
		//Event::add('Galette des Rois','Parce que la frangipane, il n\'y a que ça de vrai ! Leek smoothie has to have a delicious, puréed cauliflower component. Crême fraîche soup is just not the same without woodruff and shredded old rice. Try toasting cabbage sauce enameled with chicken lard sauce.','Paris','2015-01-02',10,'Les Rois','leskingsdelastreet@gmail.com',false);
		/* DEV TEST BLOCK */

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
		include_once( 'partials/openbooking-new-event-display.php' );
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
