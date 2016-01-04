<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.lp-dw.com/
 * @since             1.0.0
 * @package           Openbooking
 *
 * @wordpress-plugin
 * Plugin Name:       OpenBooking
 * Plugin URI:        https://github.com/lpdw/openbooking
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            LPDW
 * Author URI:        http://www.lp-dw.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       openbooking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-openbooking-activator.php
 */
function activate_openbooking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-openbooking-activator.php';
	Openbooking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-openbooking-deactivator.php
 */
function deactivate_openbooking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-openbooking-deactivator.php';
	Openbooking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_openbooking' );
register_deactivation_hook( __FILE__, 'deactivate_openbooking' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-openbooking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_openbooking() {

	$plugin = new Openbooking();
	$plugin->run();

}
run_openbooking();
