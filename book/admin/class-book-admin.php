<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://http://localhost:8085/wordpress/wp-admin/plugins.php
 * @since      1.0.0
 *
 * @package    Book
 * @subpackage Book/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Book
 * @subpackage Book/admin
 * @author     Hamad <test@gmail.com>
 */
class Book_Admin {

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
		 * defined in Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/book-admin.css', array(), $this->version, 'all' );

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
		 * defined in Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/book-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function create_book_post_type() {
		$labels = array(
			'name'               => _x( 'Books', 'post type general name', 'book' ),
			'singular_name'      => _x( 'Book', 'post type singular name', 'book' ),
			'menu_name'          => _x( 'Books', 'admin menu', 'book' ),
			'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'book' ),
			'add_new'            => _x( 'Add New', 'book', 'book' ),
			'add_new_item'       => __( 'Add New Book', 'book' ),
			'new_item'           => __( 'New Book', 'book' ),
			'edit_item'          => __( 'Edit Book', 'book' ),
			'view_item'          => __( 'View Book', 'book' ),
			'all_items'          => __( 'All Books', 'book' ),
			'search_items'       => __( 'Search Books', 'book' ),
			'parent_item_colon'  => __( 'Parent Books:', 'book' ),
			'not_found'          => __( 'No books found.', 'book' ),
			'not_found_in_trash' => __( 'No books found in Trash.', 'book' )
			
		);
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'book' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'show_in_rest'       => true, // Enables Gutenberg editor support
		);
	
		register_post_type( 'book', $args );
	}

	public function create_book_category_taxonomy() {
		$labels = array(
			'name'              => _x( 'Book Categories', 'taxonomy general name', 'your-plugin-textdomain' ),
			'singular_name'     => _x( 'Book Category', 'taxonomy singular name', 'your-plugin-textdomain' ),
			'search_items'      => __( 'Search Book Categories', 'your-plugin-textdomain' ),
			'all_items'         => __( 'All Book Categories', 'your-plugin-textdomain' ),
			'parent_item'       => __( 'Parent Book Category', 'your-plugin-textdomain' ),
			'parent_item_colon' => __( 'Parent Book Category:', 'your-plugin-textdomain' ),
			'edit_item'         => __( 'Edit Book Category', 'your-plugin-textdomain' ),
			'update_item'       => __( 'Update Book Category', 'your-plugin-textdomain' ),
			'add_new_item'      => __( 'Add New Book Category', 'your-plugin-textdomain' ),
			'new_item_name'     => __( 'New Book Category Name', 'your-plugin-textdomain' ),
			'menu_name'         => __( 'Book Category', 'your-plugin-textdomain' ),
		);
	
		$args = array(
			'hierarchical'      => true, // Set to true to make it hierarchical (like categories)
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'book-category' ),
			'show_in_rest'      => true, // Enable Gutenberg editor support
		);
	
		register_taxonomy( 'book-category', array( 'book' ), $args );
	}
	
	public function create_book_tag_taxonomy() {
		$labels = array(
			'name'                       => _x( 'Book Tags', 'taxonomy general name', 'your-plugin-textdomain' ),
			'singular_name'              => _x( 'Book Tag', 'taxonomy singular name', 'your-plugin-textdomain' ),
			'search_items'               => __( 'Search Book Tags', 'your-plugin-textdomain' ),
			'popular_items'              => __( 'Popular Book Tags', 'your-plugin-textdomain' ),
			'all_items'                  => __( 'All Book Tags', 'your-plugin-textdomain' ),
			'edit_item'                  => __( 'Edit Book Tag', 'your-plugin-textdomain' ),
			'update_item'                => __( 'Update Book Tag', 'your-plugin-textdomain' ),
			'add_new_item'               => __( 'Add New Book Tag', 'your-plugin-textdomain' ),
			'new_item_name'              => __( 'New Book Tag Name', 'your-plugin-textdomain' ),
			'separate_items_with_commas' => __( 'Separate book tags with commas', 'your-plugin-textdomain' ),
			'add_or_remove_items'        => __( 'Add or remove book tags', 'your-plugin-textdomain' ),
			'choose_from_most_used'      => __( 'Choose from the most used book tags', 'your-plugin-textdomain' ),
			'not_found'                  => __( 'No book tags found.', 'your-plugin-textdomain' ),
			'menu_name'                  => __( 'Book Tags', 'your-plugin-textdomain' ),
		);
	
		$args = array(
			'hierarchical'          => false, // Set to false to make it non-hierarchical (like tags)
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'book-tag' ),
			'show_in_rest'          => true, // Enable Gutenberg editor support
		);
	
		register_taxonomy( 'book-tag', 'book', $args );
	}
	
	public function init_book_post_type() {
        // Call each function within the init hook
        $this->create_book_post_type();
        $this->create_book_category_taxonomy();
        $this->create_book_tag_taxonomy();
    }

	public function book_meta_boxes() {
		add_meta_box(
            'book_meta_box',          // Unique ID
            'Book Information',       // Box title
            array( $this, 'meta_box_html' ), // Content callback
            'book'                    // Post type
        );
    }

	public function meta_box_html( $post ) {
		// Use nonce for verification
		wp_nonce_field( 'book_save_meta_box_data', 'book_meta_box_nonce' );
	
		// Retrieve existing values from the database
		$author = get_post_meta( $post->ID, '_book_author', true );
		$price = get_post_meta( $post->ID, '_book_price', true );
		$publisher = get_post_meta( $post->ID, '_book_publisher', true );
		$year = get_post_meta( $post->ID, '_book_year', true );
		$edition = get_post_meta( $post->ID, '_book_edition', true );
		$url = get_post_meta( $post->ID, '_book_url', true );
	
		?>
        <div class="book-meta-box-wrapper">
            <p>
                <label for="book_author">Author Name:</label>
                <input type="text" id="book_author" name="book_author" value="<?php echo esc_attr( $author ); ?>" />
            </p>
            <p>
                <label for="book_price">Price:</label>
                <input type="text" id="book_price" name="book_price" value="<?php echo esc_attr( $price ); ?>" />
            </p>
            <p>
                <label for="book_publisher">Publisher:</label>
                <input type="text" id="book_publisher" name="book_publisher" value="<?php echo esc_attr( $publisher ); ?>" />
            </p>
            <p>
                <label for="book_year">Year:</label>
                <input type="text" id="book_year" name="book_year" value="<?php echo esc_attr( $year ); ?>" />
            </p>
            <p>
                <label for="book_edition">Edition:</label>
                <input type="text" id="book_edition" name="book_edition" value="<?php echo esc_attr( $edition ); ?>" />
            </p>
            <p>
                <label for="book_url">URL:</label>
                <input type="url" id="book_url" name="book_url" value="<?php echo esc_attr( $url ); ?>" />
            </p>
        </div>
        <?php
    
	}
	
	public function save_meta_box_data( $post_id ) {
        // Check if our nonce is set and verify it.
        if ( ! isset( $_POST['book_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['book_meta_box_nonce'], 'book_save_meta_box_data' ) ) {
            return;
        }

        // Check if the user has permissions to save the data
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Sanitize and save each field
        if ( isset( $_POST['book_author'] ) ) {
            update_post_meta( $post_id, '_book_author', sanitize_text_field( $_POST['book_author'] ) );
        }

        if ( isset( $_POST['book_price'] ) ) {
            update_post_meta( $post_id, '_book_price', sanitize_text_field( $_POST['book_price'] ) );
        }

        if ( isset( $_POST['book_publisher'] ) ) {
            update_post_meta( $post_id, '_book_publisher', sanitize_text_field( $_POST['book_publisher'] ) );
        }

        if ( isset( $_POST['book_year'] ) ) {
            update_post_meta( $post_id, '_book_year', sanitize_text_field( $_POST['book_year'] ) );
        }

        if ( isset( $_POST['book_edition'] ) ) {
            update_post_meta( $post_id, '_book_edition', sanitize_text_field( $_POST['book_edition'] ) );
        }

        if ( isset( $_POST['book_url'] ) ) {
            update_post_meta( $post_id, '_book_url', esc_url( $_POST['book_url'] ) );
        }
    }
	

	

}
