<?php
/**
 * Book Meta Database Class
 *
 * Handles the creation and management of the custom meta table.
 *
 * @package    Book
 * @subpackage Book/includes
 */

class Book_Meta_Database {

    /**
     * Create the custom meta table.
     *
     * @since    1.0.0
     */
    public static function create_book_meta_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'book_meta';

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                meta_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                book_id BIGINT(20) UNSIGNED NOT NULL,
                meta_key VARCHAR(255) NULL,
                meta_value LONGTEXT NULL,
                PRIMARY KEY (meta_id),
                KEY book_id (book_id),
                KEY meta_key (meta_key(191))
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    public function register_book_meta_table() {
        global $wpdb;
        $wpdb->bookmeta = $wpdb->prefix . 'book_meta';
    }

    public function add_book_meta($book_id, $meta_key, $meta_value) {
        global $wpdb;
    
        $table = $wpdb->bookmeta;
        $wpdb->insert(
            $table,
            array(
                'book_id' => $book_id,
                'meta_key' => $meta_key,
                'meta_value' => maybe_serialize($meta_value),
            ),
            array('%d', '%s', '%s')
        );
    
    }
    

  
}

// $book_meta_db = new Book_Meta_Database();
// $book_meta_db->register_book_meta_table();
// $book_meta_db->add_book_meta(1, 'author_name', 'John Doe');