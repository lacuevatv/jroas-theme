<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post(); ?>
			<div id="home">
				<header>
				
				<?php
				$sliders = new WP_Query( 
					array(
						'post_type'       => 'sliders',
						'order'           => 'desc',
						'posts_per_page' => 10, 
						) 
				);

				if ( $sliders->have_posts() ) : ?>

					<div id="carousel-home" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php
							$sliderN = 0;
							$active = ' active';
							while ( $sliders->have_posts() ) : $sliders->the_post();
							
							if ( $sliderN != 0 ) {
								$active = '';
							}

							$metaSlider = get_post_meta( $post->ID, '_jrojas_sliders', true ); ?>

								<div class="carousel-item<?php echo $active; ?>">
									<img class="d-block w-100" src="<?php echo esc_url( $metaSlider[3] ); ?>" alt="First slide">
									<div class="carousel-caption">
										<a href="<?php echo $metaSlider[0]; ?>" class="cta cta-carousel" <?php if ( $metaSlider[2] == 'on' ) { echo 'target="_blank"'; }?>>
											<?php echo $metaSlider[1]; ?>
										</a>
									</div>
								</div>

							<?php
							$sliderN++;
							endwhile; ?>
						</div>

						<a class="carousel-control-prev" href="#carousel-home" role="button" data-slide="prev">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-prev.png" aria-hidden="true" alt="Flecha hacia la izquierda">
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carousel-home" role="button" data-slide="next">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-next.png" aria-hidden="true" alt="Flecha hacia la izquierda">
							<span class="sr-only">Next</span>
						</a>
				</div>
				<?php endif; ?>

				</header>
				
				<section id="instagram-feed">
					<div class="headline">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram-hl.png" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/instagram-hl@2x.png 2x,
						<?php echo get_template_directory_uri(); ?>/assets/images/instagram-hl@3x.png 3x" alt="instagram icon">
						<h2>INSTAGRAM</h2>
					</div>
					<div id="instafeed">
					<?php echo do_shortcode('[instagram-feed]'); ?>
					</div>
				</section>
				<section id="newsletter">
					<div class="headline">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mail.png" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/mail@2x.png 2x,
								<?php echo get_template_directory_uri(); ?>/assets/images/mail@3x.png 3x"
							alt="instagram icon">
						<h2><span> SUSCRIPCIÓN </span> NEWSLETTER</h2>
					</div>
					<form name="contacto-home" id="contacto-home">
						<div class="floating-label">
							<input maxlength="100" placeholder="Nombre y apellido" type="text" name="input-name" id="input-name" required />
							<label for="input-name">Nombre y apellido</label>
						</div>
						<div class="floating-label">
							<input placeholder="Correo electrónico" type="email" name="input-mail" id="input-mail" required />
							<label for="input-mail">Correo electrónico</label>
						</div>
						<button type="submit" form="contacto-home">
							Enviar
						</button>
					</form>
					<p class="msj-formulario-home"></p>
				</section>
			</div>

		<?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();