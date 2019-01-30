<?php
/**
 * Template Name: Contacto
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
	<main id="main" class="site-main wrapper-page-contacto" role="main">

		<?php
		while ( have_posts() ) : the_post(); ?>
	
			<?php the_title( '<header class="header-page"><h1 class="entry-title">', '</h1></header>' ); ?>
			
			<section class="wrapper-form">

				<div class="wrapper-content-wp">
					<?php the_content(); ?>
				</div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">
                            Contacto con el Artista
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contratacion-tab" data-toggle="tab" href="#contratacion" role="tab" aria-controls="contratacion" aria-selected="false">
                            Contratación de Espectáculo
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        
                        <form class="formulario" name="contact_form" id="contact_form" method="POST">
                            
                            <div class="form-group">
                                <label for="contact_name">Nombre y Apellido</label>
                                <input type="text" class="form-control" name="contact_name" placeholder="Nombre y Apellido">
                            </div>
                            
                            <div class="form-group">
                                <label for="contact_email">Correo electrónico</label>
                                <input type="email" class="form-control" name="contact_email" placeholder="Correo electrónico">
                            </div>

                            <div class="form-group">
                                <label for="contact_msj">Mensaje</label>
                                <textarea class="form-control" name="contact_msj" rows="3">Mensaje</textarea>
                            </div>

                            <div class="btn-wrapper">
								<span class="msj-formulario"></span>
                                <button type="submit" class="btn btn-submit">Enviar</button>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane fade" id="contratacion" role="tabpanel" aria-labelledby="contratacion-tab">
                        <!-- form 2 -->

                        <form class="formulario" name="contratacion_form" id="contratacion_form" method="POST">
                            
                            <div class="form-group">
                                <label for="contratacion_name">Nombre y Apellido</label>
                                <input type="text" class="form-control" name="contratacion_name" placeholder="Nombre y Apellido">
                            </div>
                            
                            <div class="form-group">
                                <label for="contratacion_email">Correo electrónico</label>
                                <input type="email" class="form-control" name="contratacion_email" placeholder="Correo electrónico">
                            </div>

                            <div class="form-group">
                                <label for="contratacion_msj">Mensaje</label>
                                <textarea class="form-control" name="contratacion_msj" rows="3">Mensaje</textarea>
                            </div>

                            <div class="btn-wrapper">
								<span class="msj-formulario"></span>
                                <button type="submit" class="btn btn-submit">Enviar</button>
                            </div>
                        </form>

                    </div>
                </div>

            </section>

            <section class="datos-contacto-wrapper">
                
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mail.png" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/mail@2x.png 2x, <?php echo get_template_directory_uri(); ?>/assets/images/mail@3x.png 3x" alt="logo-contacto" class="icon-contacto">
                
                <div class="datos-contacto">
                    <p>
                        Colón 2273
                    </p>
                    <p>
                        CP 5000 Córdoba Capital - Argentina
                    </p>
                    <p>
                        Tel.: 54-0351-4897165
                    </p>
                    <p>
                        E-mail: quilaysrl@jorgerojas.info
                    </p>
                </div>
            </section>
	
		
		

		<?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
