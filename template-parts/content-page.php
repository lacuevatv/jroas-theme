<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<?php if ( ! is_page() ) : ?>
	
	<div class="entry-meta">
		<?php jrojas_posted_by(); ?>
		<?php jrojas_posted_on(); ?>
		<span class="comment-count">
			<?php
			if ( ! empty( $discussion ) ) {
				jrojas_discussion_avatars_list( $discussion->authors );
			}
			?>
			<?php jrojas_comment_count(); ?>
		</span>
		<?php
		// Edit post link.
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers. */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'jrojas' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">' . jrojas_get_icon_svg( 'edit', 16 ),
				'</span>'
			);
		?>
	</div><!-- .meta-info -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'jrojas' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Editar <span class="screen-reader-text">%s</span>', 'jrojas' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
