<?php
/*
 * controllo se qualcuno sta provando a disinstallare il mio plugin
 * dall'esterno. Se si, allora 'die';
 */
if ( ! define( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

// Clear DB store data
// Access the DB via PHP
$books = get_post( array( 'Post_type' => 'book', 'numberposts' => -1 ) );

foreach ( $books as $book ) {
    wp_delete_post( $book->ID, false );
}
