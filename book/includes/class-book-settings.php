<?php

class Book_Settings {

    public function add_settings_page() {
        add_submenu_page(
            'edit.php?post_type=book', // Parent menu slug
            'Book Settings', // Page title
            'Book Settings', // Menu title
            'manage_options', // Capability
            'book-settings', // Menu slug
            array($this, 'settings_page_html') // Callback function
        );
    }

    public function register_settings() {
        // Register settings
        register_setting('book_settings_group', 'book_currency');
        register_setting('book_settings_group', 'books_per_page');

        // Add settings sections
        add_settings_section(
            'book_general_section', 
            'General Settings', 
            null, 
            'book-settings'
        );

        // Add settings fields
        add_settings_field(
            'book_currency',
            'Currency',
            array($this, 'currency_field_html'),
            'book-settings',
            'book_general_section'
        );

        add_settings_field(
            'books_per_page',
            'Books Per Page',
            array($this, 'books_per_page_field_html'),
            'book-settings',
            'book_general_section'
        );
    }

    public function settings_page_html() {
        ?>
        <div class="wrap">
            <h1>Book Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('book_settings_group');
                do_settings_sections('book-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function currency_field_html() {
        $currency = get_option('book_currency', 'USD');
        ?>
        <input type="text" name="book_currency" value="<?php echo esc_attr($currency); ?>" />
        <?php
    }

    public function books_per_page_field_html() {
        $books_per_page = get_option('books_per_page', 10);
        ?>
        <input type="number" name="books_per_page" value="<?php echo esc_attr($books_per_page); ?>" />
        <?php
    }
}

new Book_Settings();