<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">


        <div class="entry-content">

            <?php
            if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
                the_excerpt();
            } else {
                the_content( __( 'Continue reading', 'twentytwenty' ) );
            }
            ?>

            <!-- Form per Login -->
            <section>

            <h2>Registrati per poter accedere al servizio</h2>
            <div id="home-form">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nome_utente">Nome utente</label>
                        <input name="nome_utente" type="text" id="nome_utente">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email </label>
                        <input name="email" type="email" id="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input name="password" type="password" id="password">
                    </div>

                    <input type="submit" name="registrati" value="Registrati">
                </form>
                <p>
                    Hai gia un account? <a href="/login-page">Torna indietro e accedi</a>
                </p>
            </div>
            </section>
        </div><!-- .entry-content -->

    <div class="section-inner">
        <?php
        wp_link_pages(
            array(
                'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
                'after'       => '</nav>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            )
        );

        //		edit_post_link();

        // Single bottom post meta.
        twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

        if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

            get_template_part( 'template-parts/entry-author-bio' );

        }
        ?>

    </div><!-- .section-inner -->

    <?php

    if ( is_single() ) {

        get_template_part( 'template-parts/navigation' );

    }
    ?>


</article>
