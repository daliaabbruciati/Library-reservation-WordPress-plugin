<?php
/*
Template Name: Custom Successful Reservation
Template Post Type: page
*/

get_header();
?>

<main id="site-content">

    <?php

    if ( have_posts() ) {

        while ( have_posts() ) {
            the_post();

            get_template_part( 'template-parts/custom-pages/successful-reservation' );
        }
    }

    ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>

