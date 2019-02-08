<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="wrapper-page-novedades container-fluid">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post(); ?>
				<div class="wrapper-novedades">
					<div class="novedades">

					<?php
					get_template_part( 'template-parts/content', 'single' );

					if ( is_singular( 'attachment' ) ) {
						// Parent post navigation.
						the_post_navigation(
							array(
								/* translators: %s: parent post link */
								'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentynineteen' ), '%title' ),
							)
						);
					} elseif ( is_singular( 'post' ) ) {
						echo '<div class="container">';
						// Previous/next post navigation.
						the_post_navigation(
							array(
								'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Siguiente', 'jrojas' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Siguiente:', 'jrojas' ) . '</span> <br/>' .
									'<span class="post-title">%title</span>',
								'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Anterior', 'jrojas' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Anterior:', 'jrojas' ) . '</span> <br/>' .
									'<span class="post-title">%title</span>',
							)
						);
						echo '</div>';
					}

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				
					</div>
				</div>

			<?php
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();