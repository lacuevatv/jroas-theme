<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0.0
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'No se encontró nada', 'jrojas' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( '¿Listo para publicar tu primer post? <a href="%1$s">Empecemos</a>.', 'jrojas' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php _e( 'Lo sentimos, pero no hemos encontrado nada. Trate de nuevo con distintas palabras.', 'jrojas' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php _e( 'Parece que no encontramos lo que está buscando.', 'jrojas' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
