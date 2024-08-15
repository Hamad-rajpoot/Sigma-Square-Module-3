<?php

/**
 * Fired during plugin activation
 *
 * @link       https://http://localhost:8085/wordpress/wp-admin/plugins.php
 * @since      1.0.0
 *
 * @package    Book
 * @subpackage Book/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Book
 * @subpackage Book/includes
 * @author     Hamad <test@gmail.com>
 */
class Book_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		Book_Meta_Database::create_book_meta_table();
	}

	/**
     * Create the custom meta table.
     *
     * @since    1.0.0
     */
}
