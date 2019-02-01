<?php
/**
 * Template Name: Agenda
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
	<main id="main" class="site-main" role="main">

	<?php
		while ( have_posts() ) : the_post(); ?>

			<?php the_title( '<div class="headline"><h2>', '</h2></div>' ); ?>

			<?php 
			/*
			 * arma los datos para mostrar las obras
			*/
			$arrayAgenda = array();
			$arrayMeses = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
			$arrayDias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
			$fechaActual =  date('Y-m-d');
			
			$agendaQuery = new WP_Query( 
				array(
					'post_type'       => 'agenda',
					'order'           => 'asc',
					'orderby'   => 'meta_value',
					'meta_key'  => '_jrojas_agenda_fecha',
					'meta_query' => array(
						array(
							'key'     => '_jrojas_agenda_fecha',
							'value'   => array( date("Y-m-d",strtotime($fechaActual."- 1 month")), date("Y-m-d",strtotime($fechaActual."+ 4 month")) ),
							'type'    => 'DATE',
							'compare' => 'BETWEEN'
							),
						)
					) 
			);

			if ( $agendaQuery->have_posts() ) :
				
				while ( $agendaQuery->have_posts() ) : $agendaQuery->the_post();
					$Lugar = get_post_meta( $post->ID, '_jrojas_agenda_lugar', true );
					$Fecha = get_post_meta( $post->ID, '_jrojas_agenda_fecha', true );

					$agendaItem = array(
						'title' => get_the_title(),
						'text' => get_the_content(),
						'resumen' => get_the_excerpt(),
						'lugar' => $Lugar,
						'fecha' => $Fecha,
						'mes' => $arrayMeses[date('m', strtotime($Fecha))-1],
						'year' => date('Y', strtotime($Fecha)),
						'index-fecha' => date('m-y', strtotime($Fecha)),
					);
					
					array_push($arrayAgenda, $agendaItem );

				endwhile;
			
			endif;
			
			

			if ( ! empty($arrayAgenda) ) : ?>
				

				<section id="navegacion">
                	<div id="slick-carousel-fecha">
                    
					<?php
					$mesItem = '';
					 foreach ( $arrayAgenda as $agendaMes ) {
						
						if ( $agendaMes['mes'] != $mesItem ) {
							$mesItem = $agendaMes['mes'];
							?>
							<div class="fecha" data-fecha="<?php echo $agendaMes['index-fecha']; ?>">
								<h4><?php echo $agendaMes['year']; ?></h4>
								<h3 class="mes"><?php echo $agendaMes['mes']; ?></h3>
							</div>

						<?php } ?>
						
					<?php } ?>

					</div>
				</section>
				
				<section id="eventos">
                	<div id="slick-carousel-eventos">
                    
					<?php
					$mesIndex = '';
					$count = 1;
					$cantPost = count($arrayAgenda);

					foreach ( $arrayAgenda as $agenda ) {
						//si es el primero
						if ( $count==1 ) {
							$mesIndex = $agenda['index-fecha']; ?>

							<div class="grilla-eventos <?php echo $agenda['index-fecha']; ?>">

						<?php }

						//si cambia el index se genera otro pero primero debe cerrar el anterior
						if ( $agenda['index-fecha'] != $mesIndex ) {
							$mesIndex = $agenda['index-fecha']; ?>
							</div>
							<div class="grilla-eventos <?php echo $agenda['index-fecha']; ?>">
						<?php }

							//template que siempre se repite en el foreach
						?>

							<div class="evento">
								<div class="main-info">
									<div class="descripcion">
										<div>
											<h3 class="dia"><?php 
												$fechaaMostrar =  $arrayDias[date('N', strtotime($agenda['fecha']))] . ' ' . date('j', strtotime($agenda['fecha'])); 
												echo $fechaaMostrar;
											?>
											</h3>
											<h4 class="lugar"><?php echo $agenda['lugar']; ?></h4>
											
										</div>
										<p>
											<?php echo $agenda['title']; ?>
										</p>
									</div>
									<div class="more-info-btn" role="button">
										<span>+</span>
									</div>
								</div>
								<div class="extra-info">
									<div>
										<?php echo $agenda['text']; ?>
									</div>
									<div class="hide-info-btn" role="button"> <span>-</span> </div>
								</div>
							</div>
						<?php

						//si es el ultimo
						if ( $count == $cantPost ) { ?> 
							</div>
						<?php }

						$count++;
					}//foreach ?>

					</div>
				</section>
				

			<?php endif; ?>


		<?php endwhile; // End of the loop. ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
