<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

?>

<article class="novedad" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		
		<?php 
		if ( has_post_thumbnail()) {

			the_post_thumbnail();
			
		} ?>
		

		<?php if ( ! is_page() ) : ?>
		
		<div class="entry-meta">
			<?php jrojas_posted_on(); ?>
		</div><!-- .meta-info -->

		<?php endif; ?>

		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Seguir leyendo<span class="screen-reader-text"> "%s"</span>', 'jrojas' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'jrojas' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->

		
		<?php jrojas_entry_footer(); ?>
	</div>

</article><!-- #post-${ID} -->
