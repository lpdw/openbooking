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

		// Members page
		add_submenu_page(
			'openbooking',
			__( 'Openbooking Members', $this->plugin_name ),
			__( 'Members', $this->plugin_name ),
			'manage_options',
			'openbooking-members',
			array( $this, 'display_members_page' )
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
			'staff-member-options',
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
	 * Display Members page content.
	 *
	 * @since   1.0.0
	 */
	public function display_members_page() {
		include_once( 'partials/openbooking-members-display.php' );
	}

	/**
	 * Display Events page content.
	 *
	 * @since   1.0.0
	 */
	public function display_events_page() {
		include_once( 'partials/openbooking-events-display.php' );
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
