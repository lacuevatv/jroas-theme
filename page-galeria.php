<?php
/**
 * Template Name: Galeria
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main wrapper-page-galeria" role="main">

		<?php
		while ( have_posts() ) : the_post(); ?>

			<?php the_title( '<header class="header-page"><h1 class="entry-title">', '</h1></header>' ); ?>
			
			<div class="slider-wrapper">

			<?php
				$galeria = new WP_Query( 
					array(
						'post_type'       => 'galeria',
						'order'           => 'desc',
						'posts_per_page' => 100, 
						) 
				);

				//var_dump($galeria);
				
				if ( $galeria->have_posts() ) :
					$miniaturas = array();
					$miniaturaDefault = get_template_directory_uri() . '/assets/images/default-image.png';
					?>

					<div class="slider-galeria-bigger">

						<?php while ( $galeria->have_posts() ) : $galeria->the_post();
						
						$metaGaleria = get_post_meta( $post->ID, '_jrojas_galeria', true );
						$video = false;
						//chequea si hay video
						if ( $metaGaleria[0] != '' ) {
							$video = true;
							$codigoVideo = jr_getDataVideo($metaGaleria[0]);
						}

						if ( $metaGaleria[2] != '' ) {
							array_push($miniaturas, esc_url( $metaGaleria[2] ) );
						} elseif( $metaGaleria[1] != '' ) {
							array_push($miniaturas, esc_url( $metaGaleria[1] ) );
						} else {
							array_push($miniaturas, esc_url( $miniaturaDefault ) );
						}
						?>

							<div class="item-slider-wrapper">
								<div class="contenido">
									<?php 
									if ( $video ) : ?>
										<iframe src="https://www.youtube.com/embed/<?php echo $codigoVideo; ?>?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									<?php else : ?>
										<img src="<?php echo esc_url( $metaGaleria[1] ); ?>" alt="Galería Jorge Rojas">
									<?php endif; ?>
									
									<div class="info-item">
										<h4 class="date">
											<?php echo get_the_date('d/m/Y'); ?>
										</h4>
										<h2 class="titulo">
											<?php the_title(); ?>
										</h2>
									</div>
								</div>
							</div><!--//.item-slider-wrapper-->

						<?php endwhile; ?>

					</div><!--//.slider-galeria-bigger-->

					<div class="slider-miniaturas">
						<div class="slider-galeria-nav">
						<?php 
							for ($i=0; $i < count($miniaturas); $i++) { ?>
								<div class="miniatura">
									<img src="<?php echo $miniaturas[$i]; ?>" alt="Galería Jorge Rojas">
								</div>
							<?php } ?>

						</div><!--//.slider-galeria-nav-->
					</div><!--//.slider-miniatura-->

				<?php endif;//endif galeria ?>

            </div><!--//.slider-wrapper-->

		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
