<?php
/**
 * Template Name: Obras
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
	<main id="main" class="wrapper-page-obra" role="main">

		<?php
		while ( have_posts() ) : the_post(); ?>

			<?php the_title( '<h1 class="sr-only">', '</h1>' ); ?>
			
			<?php 
			/*
			 * arma los datos para mostrar las obras
			*/
			$arrayObras = array();

			$obras = new WP_Query( 
				array(
					'post_type'       => 'obras',
					'order'           => 'desc',
					'meta_key' => '_jrojas_obras',
    				'orderby' => 'jrojas_fecha',
					) 
			);
			
			$defaultMiniatura = get_template_directory_uri() . '/assets/images/default-image-scuare.png';

			if ( $obras->have_posts() ) :
				
				while ( $obras->have_posts() ) : $obras->the_post();

					$obra = array(
						'title' => get_the_title(),
						'text' => get_the_content(),
						'metadata' => $metaData = get_post_meta( $post->ID, '_jrojas_obras', true ),
						'miniatura' => ( isset($metaData[4]) && $metaData[4] != '' ) ? esc_url( $metaData[4] ) : $defaultMiniatura,
					);
					
					array_push($arrayObras, $obra );

				endwhile;
			
			endif;
			
			

			if ( ! empty($arrayObras) ) : ?>

			<div class="slider-wrapper-obra">
                <div class="background-page">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bgd-obra.jpg" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/bgd-obra@2x.jpg 2x" alt="Jorge Rojas - Obras">
                </div>
                
                <h3 class="data-fecha">
					<?php echo $arrayObras[0]['metadata'][0]; ?>
				</h3>

			<!--HEADER SLIDER-->          
                <div class="header-slider">

					<?php foreach ($arrayObras as $obrita ) { ?>
						<div class="item-header">
                        <img src="<?php echo $obrita['miniatura']; ?>" alt="Obras Jorge Rosas">
					</div>
					<?php } ?>
					
				</div>

			<!--BODY SLIDER-->
				<div class="body-slider">

				<?php foreach ($arrayObras as $obrita ) { ?>

					<div class="item-body">
						
						<div class="left">
                            <div class="info-disco">
                                <p class="fecha">
                                    <?php echo $obrita['metadata']['0']; ?>
                                </p>
                                <h2 class="titulo">
									<?php echo $obrita['title']; ?>
                                </h2>
                                <div class="resumen">
									<?php echo $obrita['text']; ?>
								</div>
                            </div>
                            <img src="<?php echo $obrita['miniatura']; ?>" alt="<?php echo $obrita['title']; ?> - Obras Jorge Rosas">
                        </div>

                        <div class="right">
                            <div class="info-disco">
								<p class="fecha">
                                    <?php echo $obrita['metadata']['0']; ?>
                                </p>
                                <h2 class="titulo">
									<?php echo $obrita['title']; ?>
                                </h2>
                                <div class="resumen">
									<?php echo $obrita['text']; ?>
								</div>
                            </div>
                            
                            <div class="canciones">
								<?php if ( $obrita['metadata']['5'] != '' ) : ?>
									<h3>
										Canciones del disco
									</h3>
									<ol class="lista-canciones">
										<?php 
										 $canciones = explode('_', $obrita['metadata']['5']); 
										 foreach ($canciones as $cancion) {
											 echo '<li>'.$cancion.'</li>';
										 }
										?>
									</ol>
								<?php endif; ?>
                            </div>

                            <div class="meta-data-disco">
                                
								<?php 
								if ( $obrita['metadata']['2'] != '' || $obrita['metadata']['3'] != '' ) : ?>

									<h3>
										Escuchar Online
									</h3>

									<?php if ( $obrita['metadata']['2'] != '' ) : ?>
										<a href="<?php echo esc_url( $obrita['metadata']['2'] ); ?>" class="link-escuchar" target="_blank">
											Apple music
										</a>
									<?php endif; ?>
									<?php if ( $obrita['metadata']['3'] != '' ) : ?>
										<a href="<?php echo esc_url( $obrita['metadata']['3'] ); ?>" class="link-escuchar" target="_blank">
											Spotify
										</a>
									<?php endif; ?>
									
								<?php endif; ?>
                            </div>

                            <div class="action-btn-wrapper">
								<?php if ( $obrita['metadata']['2'] != '' || $obrita['metadata']['3'] != '' ) : ?>
									<a href="#" class="comprar-btn">
										Comprar
									</a>
								<?php endif; ?>
                            </div>
                        </div>
					</div><!--item-body-->

				<?php } ?>

				</div>

			</div><!-- //.slider-wrapper-obra-->

			<?php endif;

		endwhile; // End of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
