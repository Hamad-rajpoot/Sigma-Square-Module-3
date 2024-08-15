<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://http://localhost:8085/wordpress/wp-admin/plugins.php
 * @since             1.0.0
 * @package           Book
 *
 * @wordpress-plugin
 * Plugin Name:       Book
 * Plugin URI:        https://http://localhost:8085/wordpress/wp-admin/plugins.php
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Hamad
 * Author URI:        https://http://localhost:8085/wordpress/wp-admin/plugins.php/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       book
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BOOK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-book-activator.php
 */
function activate_book() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-book-activator.php';
	Book_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-book-deactivator.php
 */
function deactivate_book() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-book-deactivator.php';
	Book_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_book' );
register_deactivation_hook( __FILE__, 'deactivate_book' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-book.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-book-meta-database.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_book() {

	$plugin = new Book();
	$plugin->run();

}
run_book();
