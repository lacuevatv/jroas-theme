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

<li class="novedad" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php
		if ( is_singular() ) :
			echo '<header class="entry-header">';
			the_title( '<h1 class="entry-title">', '</h1>' );
			echo '	</header><!-- .entry-header -->';
		endif;
		?>

	<div class="titulo-novedad-mobil">
		<h5 class="fecha-novedad">
			<?php jrojas_posted_on(); ?>
		</h5>
		<?php the_title( '<h2 class="titulo-novedad">', '</h2>' ); ?>
		
	</div>

	<div class="imagen-novedad">
		<?php 
		if ( has_post_thumbnail()) {
			echo '<img src="' . get_the_post_thumbnail_url(null, 'full') . '" alt="imagen-novedad">';
		} else { ?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-image.png" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/default-image@2x.png 2x" alt="imagen-novedad">
		<?php } ?>
		
	</div>                     

	<div class="data-novedad">
		<div class="titulo-pc">
			<h5 class="fecha-novedad">
				<?php jrojas_posted_on(); ?>
			</h5>
			<?php the_title( '<h2 class="titulo-novedad">', '</h2>' ); ?>
		</div>

		<?php
		the_content(
			sprintf(
				wp_kses(
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
		?>

		<a href="<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="link-novedad">
			Leer más
		</a>
	</div>

	<?php //the_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		/*the_content(
			sprintf(
				wp_kses(
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
		);*/
		?>
	</div><!-- .entry-content -->

	
</li><!-- #post-${ID} -->
