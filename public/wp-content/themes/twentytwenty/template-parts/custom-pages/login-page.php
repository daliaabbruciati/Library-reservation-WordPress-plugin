
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'twentytwenty' ) );
			}
			?>

            <!-- Form per Login -->
            <header id="home-header">
                <h1>Benvenuto nella Biblioteca</h1>
                <p>
                    Questo portale ti permetterà di scegliere e prenotare il tuo posto in sala studio nel giorno e nella fascia oraria che desideri.
                    Accedi o registrati per proseguire.
                </p>
            </header>
            <div id="home-form" class="inner-container">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input name="email" type="email" id="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" >Password</label>
                        <input name="password" type="password" id="password">
                    </div>

                    <input type="submit" name="submit" value="Login">
                </form>
                <p>
                    Non sei ancora registrato? <a href="/signup-page">Crea account</a>
                </p>
            </div>
		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

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

	/*
	 * Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
