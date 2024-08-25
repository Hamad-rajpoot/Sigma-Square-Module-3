<?php

class Book_Shortcode {

public function render_book_shortcode($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(
        array(
             'id'           => '',
            'author_name'  => '',
            'price'  => '',
             'year'         => '',
             'publisher'    => '',
             'edition'    => '',
             'URL'    => '',
        ),
        $atts,
        'book'
    );

    if (empty($atts['id'])) {
        return 'Please provide a book ID.';
    }

    // Get the book data from the custom meta table
    $book_meta_db = new Book_Meta_Database();
    
    $book_data = array(
        'author_name' => $book_meta_db->get_book_meta($atts['id'], 'author_name'),
        'year'  => $book_meta_db->get_book_meta($atts['id'], 'book_price'),
        'year'  => $book_meta_db->get_book_meta($atts['id'], 'year'),
        'publisher' => $book_meta_db->get_book_meta($atts['id'], 'publisher'),
        'edition' => $book_meta_db->get_book_meta($atts['id'], 'edition'),
        // Add more fields as necessary
    );

    var_dump ($book_data['publisher']);

    // Check if specific attributes were provided in the shortcode
    if (!empty($atts['author_name']) && $atts['author_name'] !== $book_data['author_name']) {
        return 'No book found with the specified author.';
    }
    if (!empty($atts['year']) && $atts['year'] !== $book_data['year']) {
        return 'No book found with the specified year.';
    }
    if (!empty($atts['publisher']) && $atts['publisher'] !== $book_data['publisher']) {
        return 'No book found with the specified publisher.';
    }

    // Display the book information
    $output = '<div class="book-info">';
    if (!empty($book_data['author_name'])) {
        $output .= '<p><strong>Author:</strong> ' . esc_html($book_data['author_name']) . '</p>';
    }
    if (!empty($book_data['year'])) {
        $output .= '<p><strong>Year:</strong> ' . esc_html($book_data['year']) . '</p>';
    }
    if (!empty($book_data['publisher'])) {
        $output .= '<p><strong>Publisher:</strong> ' . esc_html($book_data['publisher']) . '</p>';
    }
    if (!empty($book_data['publisher'])) {
        $output .= '<p><strong>Price:</strong> ' . esc_html($book_data['book_price']) . '</p>';
    }
    $output .= '</div>';

    return $output;
}
}
new Book_Shortcode();
