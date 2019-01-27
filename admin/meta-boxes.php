<?php
/**
 * META BOXES
 *
 * @link https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 * @version 1.0
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*------------------
* METABOX 1: PARTNERS
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_partner' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_partner() {
        add_meta_box(
            'url_partner',
            __( 'url', 'jrojas' ),
            'jrojas_add_metabox_partner_callback',
            'partners'
        );
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_partner' );

if ( ! function_exists( 'jrojas_add_metabox_partner_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_partner()
	 */
    function jrojas_add_metabox_partner_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_url_partner', 'jrojas_url_partner_nonce' );

        $metaPartner = get_post_meta( $post->ID, '_url_partner', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Insertar url del partner (opcional).', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
        		<div class="metabox_input_data">
	            	<label for="jrojas_url_partner">
						<?php esc_html_e( 'Url', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_url_partner" id="jrojas_url_partner" value="<?php echo isset($metaPartner) ? esc_attr( $metaPartner) : ''; ?>"/>		
	            </div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_partner' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_partner()
	 */
    function jrojas_save_metabox_partner( $post_id, WP_Post $post ) {
       
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    // Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_url_partner_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_url_partner_nonce'], 'jrojas_url_partner' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
        }
		
        // Guardamos:

        $dato = isset($POST_['jrojas_url_partner']) ? $POST_['jrojas_url_partner'] : '';
        update_post_meta( $post_id, '_url_partner', $dato );
        
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_partner', 10, 2 );



/*------------------
* METABOX 2: SLIDERS
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_sliders' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_sliders() {
        add_meta_box(
            'datos-adicionales',
            __( 'Datos Adicionales', 'jrojas' ),
            'jrojas_add_metabox_sliders_callback',
			'sliders'
        );
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_sliders' );

if ( ! function_exists( 'jrojas_add_metabox_sliders_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_sliders()
	 */
    function jrojas_add_metabox_sliders_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_sliders', 'jrojas_sliders_nonce' );

        $metaSliders = get_post_meta( $post->ID, '_jrojas_sliders', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Agregar imagen pc y imagen movil, texto del boton y url.', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
        		<div class="metabox_input_data">
	            	<label for="jrojas_url_sliders">
						<?php esc_html_e( 'Url', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_url_sliders" id="jrojas_url_sliders" value="<?php echo isset($metaSliders[0]) ? esc_attr( $metaSliders[0]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_btn_sliders">
						<?php esc_html_e( 'Texto del botón', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_btn_sliders" id="jrojas_btn_sliders" value="<?php echo isset($metaSliders[1]) ? esc_attr( $metaSliders[1]) : _e( 'Más información','jrojas'); ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_open_sliders">
						<?php esc_html_e( 'Abrir en ventana nueva', 'jrojas' ); ?>
					</label>
            		<input type="checkbox" class="input-checkbox" name="jrojas_open_sliders" id="jrojas_open_sliders" value="<?php echo isset($metaSliders[2]) ? esc_attr( $metaSliders[2]) : '' ?>" <?php if (isset($metaSliders[2]) && $metaSliders[2] == '1') {echo 'checked'; } ?>/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_imagen_sliders">
						<?php esc_html_e( 'Imagen', 'jrojas' ); ?>
					</label>
					<input type="text" name="jrojas_imagen_sliders" id="jrojas_url_sliders" value="<?php echo isset($metaSliders[3]) ? esc_attr( $metaSliders[3]) : ''; ?>"/>
					<button type="button" class="upload-images button-primary">Agregar imagen</button>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_imagen_movil_sliders">
						<?php esc_html_e( 'Imagen p movil', 'jrojas' ); ?>
					</label>
					<input type="text" name="jrojas_imagen_movil_sliders" id="jrojas_imagen_movil_sliders" value="<?php echo isset($metaSliders[4]) ? esc_attr( $metaSliders[4]) : ''; ?>"/>
					<button type="button" class="upload-images button-primary">Agregar imagen</button>
	            </div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_sliders' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_sliders()
	 */
    function jrojas_save_metabox_sliders( $post_id, WP_Post $post ) {
        // Si no se reciben los datos o no hay ninguno, salir de la función.
		$dato1 = isset( $_POST['jrojas_url_sliders'] ) ? 1 : 0;
		$dato2 = isset( $_POST['jrojas_btn_sliders'] ) ? 1 : 0;
		$dato3 = isset( $_POST['jrojas_open_sliders'] ) ? 1 : 0;
		$dato4 = isset( $_POST['jrojas_imagen_sliders'] ) ? 1 : 0;
		$dato5 = isset( $_POST['jrojas_imagen_movil_sliders'] ) ? 1 : 0;
		$datos_sumados = $dato1 + $dato2 + $dato3 + $dato4 + $dato5;
		
		if ( $datos_sumados == 0  ) {
            return;
        };
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_sliders_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_sliders_nonce'], 'jrojas_sliders' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataSlider = array();
		array_push($dataSlider, esc_url( $_POST['jrojas_url_sliders'] ) );

		array_push($dataSlider, sanitize_text_field( $_POST['jrojas_btn_sliders'] ) );
		
		array_push( $dataSlider, esc_attr( isset($_POST['jrojas_open_sliders']) ? $_POST['jrojas_open_sliders'] : '0' )  );

		array_push($dataSlider, esc_url( $_POST['jrojas_imagen_sliders'] ) );

		array_push($dataSlider, esc_url( $_POST['jrojas_imagen_movil_sliders'] ) );
		
        if ( ! empty( $dataSlider ) ) {
        	update_post_meta( $post_id, '_jrojas_sliders', $dataSlider );
        }
        
        
        
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_sliders', 10, 2 );


/*------------------
* METABOX 3: CREW
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_crew' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_crew() {
        add_meta_box(
            'cargo',
            __( 'Cargo', 'jrojas' ),
            'jrojas_add_metabox_crew_callback',
            'crew'
        );
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_crew' );

if ( ! function_exists( 'jrojas_add_metabox_crew_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_partner()
	 */
    function jrojas_add_metabox_crew_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_crew', 'jrojas_crew_nonce' );

        $metaCrew = get_post_meta( $post->ID, '_crew', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Insertar el cargo (opcional).', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
        		<div class="metabox_input_data">
	            	<label for="jrojas_cargo_crew">
						<?php esc_html_e( 'Cargo', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_cargo_crew" id="jrojas_cargo_crew" value="<?php echo isset($metaCrew) ? sanitize_text_field( $metaCrew) : ''; ?>"/>		
	            </div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_crew' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_partner()
	 */
    function jrojas_save_metabox_crew( $post_id, WP_Post $post ) {
        
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    // Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_crew_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_crew_nonce'], 'jrojas_crew' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
        }
		
        // Guardamos:

        
        update_post_meta( $post_id, '_crew', sanitize_text_field( $_POST['jrojas_cargo_crew'] ) );
        
        
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_crew', 10, 2 );


/*------------------
* METABOX 4: META INFO RESUMEN
* aparece en destinos, cursos y alojamientos
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_meta_info_resumen' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_meta_info_resumen() {
        add_meta_box(
            'meta-resumen',
            __( 'Resumen:', 'jrojas' ),
            'jrojas_add_metabox_meta_info_resumen_callback',
			'destinos'
		);
		add_meta_box(
            'meta-resumen',
            __( 'Resumen:', 'jrojas' ),
            'jrojas_add_metabox_meta_info_resumen_callback',
			'alojamientos'
		);
		add_meta_box(
            'meta-resumen',
            __( 'Resumen:', 'jrojas' ),
            'jrojas_add_metabox_meta_info_resumen_callback',
			'cursos'
		);
		
		add_meta_box(
            'meta-resumen',
            __( 'Resumen:', 'jrojas' ),
            'jrojas_add_metabox_meta_info_resumen_callback',
			'programas'
		);
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_meta_info_resumen' );

if ( ! function_exists( 'jrojas_add_metabox_meta_info_resumen_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_destinos()
	 */
    function jrojas_add_metabox_meta_info_resumen_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_meta_info_resumen', 'jrojas_meta_info_resumen_nonce' );

        $metaInfoResumen = get_post_meta( $post->ID, '_jrojas_meta_info_resumen', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Agregar meta info.', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
        		<div class="metabox_input_data">
	            	<label for="jrojas_meta_1">
						<?php esc_html_e( 'Info 1', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_meta_1" id="jrojas_meta_1" value="<?php echo isset($metaInfoResumen[0]) ? sanitize_text_field( $metaInfoResumen[0]) : ''; ?>"/>		
				</div>

				<div class="metabox_input_data">
	            	<label for="jrojas_meta_2">
						<?php esc_html_e( 'Info 2', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_meta_2" id="jrojas_meta_2" value="<?php echo isset($metaInfoResumen[1]) ? sanitize_text_field( $metaInfoResumen[1]) : ''; ?>"/>		
				</div>

				<div class="metabox_input_data">
	            	<label for="jrojas_meta_3">
						<?php esc_html_e( 'Info 3', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_meta_3" id="jrojas_meta_3" value="<?php echo isset($metaInfoResumen[2]) ? sanitize_text_field( $metaInfoResumen[2]) : ''; ?>"/>		
				</div>
            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'jrojas_save_metabox_meta_info_resumen' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_meta_info_resumen()
	 */
    function jrojas_save_metabox_meta_info_resumen( $post_id, WP_Post $post ) {
        // Si no se reciben los datos o no hay ninguno, salir de la función.
		$dato1 = isset( $_POST['jrojas_meta_1'] ) ? 1 : 0;
		$dato2 = isset( $_POST['jrojas_meta_2'] ) ? 1 : 0;
		$dato3 = isset( $_POST['jrojas_meta_3'] ) ? 1 : 0;
		$datos_sumados = $dato1 + $dato2 + $dato3;
		
		if ( $datos_sumados == 0  ) {
            return;
        };
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_meta_info_resumen_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_meta_info_resumen_nonce'], 'jrojas_meta_info_resumen' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataResumen = array();
		array_push($dataResumen, sanitize_text_field( $_POST['jrojas_meta_1'] ) );
		array_push($dataResumen, sanitize_text_field( $_POST['jrojas_meta_2'] ) );
		array_push($dataResumen, sanitize_text_field( $_POST['jrojas_meta_3'] ) );
			
        if ( ! empty( $dataResumen ) ) {
        	update_post_meta( $post_id, '_jrojas_meta_info_resumen', $dataResumen );
        }

 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_meta_info_resumen', 10, 2 );


/*------------------
* METABOX 5: GALERÍA DE IMAGENES
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_galeria_imagenes' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_galeria_imagenes() {
        add_meta_box(
            'galeria_imagenes',
            __( 'Galería de imágenes', 'jrojas' ),
            'jrojas_add_metabox_galeria_imagenes_callback',
			'destinos'
		);
		
		add_meta_box(
            'galeria_imagenes',
            __( 'Galería de imágenes', 'jrojas' ),
            'jrojas_add_metabox_galeria_imagenes_callback',
			'programas'
        );
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_galeria_imagenes' );

if ( ! function_exists( 'jrojas_add_metabox_galeria_imagenes_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_galeria_imagenes()
	 */
    function jrojas_add_metabox_galeria_imagenes_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_galeria_imagenes', 'jrojas_galeria_imagenes_nonce' );

        $imagenes = get_post_meta( $post->ID, '_jrojas_galeria_imagenes', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Seleccionar imágenes para la galería.', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
        		
				<div class="metabox_input_data">
					<input type="hidden" name="jrojas_imagenes" id="jrojas_imagenes" value="<?php echo isset($imagenes) ? esc_attr( $imagenes) : ''; ?>"/>
	            </div>
				<div class="wrapper-galeria-admin-metabox">
					<button type="button" class="upload-imagenes button-primary">Agregar imagenes</button>
					<ul class="imagenes-galeria">
						<?php 
						if ( isset($imagenes) && $imagenes != '' ) {
							$imagenes = explode( ',', $imagenes);
							$contador = 1;
							foreach ($imagenes as $imagen) {
								if ( $imagen != '' ) :
								$urlImagen = wp_get_attachment_image_src($imagen, 'full');
									echo '<li data-id="'.$imagen.'" data-orden="'.$contador.'"><button class="del-image" data-id="'.$imagen.'"></button><img src="'.$urlImagen[0].'"></li>';

									$contador++;
								endif;
							}

						}
						?>
					</ul>
				</div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_galeria_imagenes' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_sliders()
	 */
    function jrojas_save_metabox_galeria_imagenes( $post_id, WP_Post $post ) {		
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_galeria_imagenes_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_galeria_imagenes_nonce'], 'jrojas_galeria_imagenes' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		update_post_meta( $post_id, '_jrojas_galeria_imagenes', sanitize_text_field($_POST['jrojas_imagenes']) );
        
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_galeria_imagenes', 10, 2 );


/*------------------
* METABOX 6: SELECCIONAR CURSOS
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_select_cursos' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_select_cursos() {
        add_meta_box(
            'select_cursos',
            __( 'Cursos del destino:', 'jrojas' ),
            'jrojas_add_metabox_select_cursos_callback',
			'destinos'
		);

		add_meta_box(
            'select_cursos',
            __( 'Cursos del destino:', 'jrojas' ),
            'jrojas_add_metabox_select_cursos_callback',
			'programas'
		);
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_select_cursos' );

if ( ! function_exists( 'jrojas_add_metabox_select_cursos_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_select_cursos()
	 */
    function jrojas_add_metabox_select_cursos_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_select_cursos', 'jrojas_select_cursos_nonce' );

		$cursosSelected = get_post_meta( $post->ID, '_jrojas_meta_select_cursos', true ); ?>

		<div class="jrojas_metabox_wrapper">
			<div class="jrojas_metabox_input_data_wrapper">
				<input type="hidden" name="cursos_id" id="cursos_id" value="<?php echo isset($cursosSelected) ? $cursosSelected : ''; ?>">
					<?php 
					//busca cursos cargados
					$cursos = new WP_Query( array(
						'post_type' => 'cursos',
						)
					);
					if ($cursos->have_posts()) : ?>

						<p>
							<?php _e('Seleccionar los cursos de este destino.', 'jrojas' ); ?>
						</p>

						<?php while ( $cursos->have_posts() ) : $cursos->the_post();
							$nombre = get_the_title();
							$id = get_the_id();
							$resumen = get_the_excerpt();
							?>
							
							<div class="metabox_input_data">
								<input type="checkbox" class="input-checkbox input_cursos" name="curso_id" data-id="<?php echo $id; ?>"<?php if ( strpos($cursosSelected, $id.',') !== false ) { echo ' checked'; }?>>
								<label for="curso_id">
									<?php echo $nombre; ?>
								</label>
							</div>

						<?php endwhile; ?>

					<?php else : ?>

						<p>
							<?php _e('No hay ningún curso cargado.', 'jrojas' ); ?>
						</p>

					<?php endif; ?>
			</div>
		</div>
		
		<?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_select_cursos' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_select_cursos_callback()
	 */
    function jrojas_save_metabox_select_cursos( $post_id, WP_Post $post ) {
       		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_select_cursos_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_select_cursos_nonce'], 'jrojas_select_cursos' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		
        update_post_meta( $post_id, '_jrojas_meta_select_cursos', sanitize_text_field($_POST['cursos_id']) );

 	}
}

add_action( 'save_post', 'jrojas_save_metabox_select_cursos', 10, 2 );


/*------------------
* METABOX 7: SELECCIONAR DESTINOS
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_select_destinos' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_select_destinos() {
        add_meta_box(
            'select_destinos',
            __( 'Destinos del curso:', 'jrojas' ),
            'jrojas_add_metabox_select_destinos_callback',
			'cursos'
		);
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_select_destinos' );

if ( ! function_exists( 'jrojas_add_metabox_select_destinos_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_select_destinos()
	 */
    function jrojas_add_metabox_select_destinos_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_select_destinos', 'jrojas_select_destinos_nonce' );

		$destinosSelected = get_post_meta( $post->ID, '_jrojas_meta_select_destinos', true ); ?>

		<div class="jrojas_metabox_wrapper">
			<input type="hidden" name="destinos_id" id="destinos_id" value="<?php echo isset($destinosSelected) ? $destinosSelected : ''; ?>">
			<?php 
			//busca destinos cargados
			$destinos = new WP_Query( array(
				'post_type' => 'destinos',
				)
			);
			if ($destinos->have_posts()) : ?>

				<p>
					<?php _e('Seleccionar los destinos para cursar este curso.', 'jrojas' ); ?>
				</p>
				
				<div class="jrojas_metabox_input_data_wrapper">
					<?php while ( $destinos->have_posts() ) : $destinos->the_post();
						$nombre = get_the_title();
						$id = get_the_id();
						$resumen = get_the_excerpt();
						?>
						<div class="metabox_input_data">
							<input type="checkbox" class="input-checkbox input_destinos" name="destino_id" data-id="<?php echo $id; ?>"<?php if ( strpos($destinosSelected, $id.',') !== false ) { echo ' checked'; }?>>
							<label for="destino_id">
								<?php echo $nombre; ?>
							</label>
						</div>

					<?php endwhile; ?>
			</div>

		<?php else : ?>

			<p>
				<?php _e('No hay ningún destino cargado.', 'jrojas' ); ?>
			</p>

		<?php endif; ?>
		
		</div>
		
		<?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_select_destinos' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_select_destinos_callback()
	 */
    function jrojas_save_metabox_select_destinos( $post_id, WP_Post $post ) {
       		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_select_destinos_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_select_destinos_nonce'], 'jrojas_select_destinos' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		
	    
	    

        update_post_meta( $post_id, '_jrojas_meta_select_destinos', sanitize_text_field($_POST['destinos_id']) );

 	}
}

add_action( 'save_post', 'jrojas_save_metabox_select_destinos', 10, 2 );


/*------------------
* METABOX 8: HOME: Activar Sliders
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_home_sliders' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_home_sliders() {
		global $post;
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

		if( $pageTemplate == 'page-home.php' || $pageTemplate == 'admin/page-home.php' ) {
			add_meta_box(
				'home-slider:',
				__( 'Slider Home', 'jrojas' ),
				'jrojas_add_metabox_home_sliders_callback',
				'page'
			);
			
			
		}
        
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_home_sliders' );

if ( ! function_exists( 'jrojas_add_metabox_home_sliders_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_home_sliders()
	 */
    function jrojas_add_metabox_home_sliders_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_home_sliders', 'jrojas_home_sliders_nonce' );

		$checkHomeSliders = get_post_meta( $post->ID, '_jrojas_home_sliders', true );
		
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Mostrar el slider de la página de inicio' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
        		<div class="metabox_input_data">
					<label for="jrojas_home_sliders"><?php esc_html_e( 'Activar Slider', 'jrojas' ); ?></label>
					<input class="input-checkbox" type="checkbox" name="jrojas_home_sliders" id="jrojas_home_sliders" value="<?php echo isset($checkHomeSliders) ? esc_attr( $checkHomeSliders) : '' ?>" <?php if (isset($checkHomeSliders) && $checkHomeSliders == '1') {echo 'checked'; } ?>/>
				</div>
			</div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_home_sliders' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_sliders()
	 */
    function jrojas_save_metabox_home_sliders( $post_id, WP_Post $post ) {
        // Si no se reciben los datos o no hay ninguno, salir de la función.
		
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_home_sliders_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_home_sliders_nonce'], 'jrojas_home_sliders' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		update_post_meta( $post_id, '_jrojas_home_sliders', esc_attr( isset($_POST['jrojas_home_sliders']) ? $_POST['jrojas_home_sliders'] : '0')  );
    
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_home_sliders', 10, 2 );


/*------------------
* METABOX 9: ACTIVAR OTROS DESTINOS
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_home_destinos' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_home_destinos() {
		global $post;
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

		if( $pageTemplate == 'page-home.php' || $pageTemplate == 'admin/page-home.php' ) {
			add_meta_box(
				'home-destinos:',
				__( 'Destinos Home', 'jrojas' ),
				'jrojas_add_metabox_home_destinos_callback',
				'page'
			);	
		}
        
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_home_destinos' );

if ( ! function_exists( 'jrojas_add_metabox_home_destinos_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_home_detinos()
	 */
    function jrojas_add_metabox_home_destinos_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_home_destinos', 'jrojas_home_destinos_nonce' );

        $metaDestinos = get_post_meta( $post->ID, '_jrojas_home_destinos', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Mostrar últimos destinos cargados' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
				<div class="metabox_input_data">
					<label for="jrojas_home_destinos"><?php esc_html_e( 'Activar Destinos', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_home_destinos" id="jrojas_home_destinos" value="<?php echo isset($metaDestinos[0]) ? esc_attr( $metaDestinos[0]) : '' ?>" <?php if (isset($metaDestinos[0]) && $metaDestinos[0] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_numeros_destinos">
						<?php esc_html_e( 'Número a mostrar', 'jrojas' ); ?>
					</label>
            		<input type="number" name="jrojas_home_numeros_destinos" id="jrojas_home_numeros_destinos" value="<?php echo isset($metaDestinos[1]) ? esc_attr( $metaDestinos[1]) : '5'; ?>"/>		
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_home_destinos_ver_mas"><?php esc_html_e( 'Bloque Leer más', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_home_destinos_ver_mas" id="jrojas_home_destinos_ver_mas" value="<?php echo isset($metaDestinos[2]) ? esc_attr( $metaDestinos[2]) : '' ?>" <?php if (isset($metaDestinos[2]) && $metaDestinos[2] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_url_destinos">
						<?php esc_html_e( 'Url Pagina destinos', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_url_destinos" id="jrojas_home_url_destinos" value="<?php echo isset($metaDestinos[3]) ? esc_url( $metaDestinos[3]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_titulo_destinos">
						<?php esc_html_e( 'Título bloque', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_titulo_destinos" id="jrojas_home_titulo_destinos" value="<?php echo isset($metaDestinos[4]) ? esc_html( $metaDestinos[4]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_home_destinos_texto"><?php esc_html_e( 'Texto del bloque', 'jrojas' ); ?></label>	
					<textarea name="jrojas_home_destinos_texto" id="jrojas_home_destinos_texto"><?php echo isset($metaDestinos[5]) ?  esc_textarea($metaDestinos[5]) : '' ?></textarea>
				</div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_home_destinos' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_sliders()
	 */
    function jrojas_save_metabox_home_destinos( $post_id, WP_Post $post ) {
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_home_destinos_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_home_destinos_nonce'], 'jrojas_home_destinos' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataDestinos = array();

		array_push($dataDestinos, esc_attr( $_POST['jrojas_home_destinos'] ) );
		array_push($dataDestinos, sanitize_text_field( $_POST['jrojas_home_numeros_destinos'] ) );
		array_push($dataDestinos, esc_attr( isset( $_POST['jrojas_home_destinos_ver_mas'] ) ? $_POST['jrojas_home_destinos_ver_mas'] : '0' ) );
		array_push($dataDestinos, esc_url( $_POST['jrojas_home_url_destinos'] ) );
		array_push($dataDestinos, sanitize_text_field( $_POST['jrojas_home_titulo_destinos'] ) );
		array_push($dataDestinos, sanitize_textarea_field( $_POST['jrojas_home_destinos_texto'] ) );
		
		
        if ( ! empty( $dataDestinos ) ) {
        	update_post_meta( $post_id, '_jrojas_home_destinos', $dataDestinos );
        }
    
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_home_destinos', 10, 2 );


/*------------------
* METABOX 10: Separador
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_home_separador' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_home_separador() {
		global $post;
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

		if( $pageTemplate == 'page-home.php' || $pageTemplate == 'admin/page-home.php' ) {
			add_meta_box(
				'home-separador:',
				__( 'Bloque Separador', 'jrojas' ),
				'jrojas_add_metabox_home_separador_callback',
				'page'
			);	
		}
        
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_home_separador' );

if ( ! function_exists( 'jrojas_add_metabox_home_separador_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_home_sliders()
	 */
    function jrojas_add_metabox_home_separador_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_home_separador', 'jrojas_home_separador_nonce' );

        $separadorData = get_post_meta( $post->ID, '_jrojas_home_separador', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Activar bloque separador y definir los datos y las imágenes.', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
				<div class="metabox_input_data">
					<label for="jrojas_home_separador"><?php esc_html_e( 'Activar bloque separador', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_home_separador" id="jrojas_home_separador" value="<?php echo isset($separadorData[0]) ? esc_attr( $separadorData[0]) : '' ?>" <?php if (isset($separadorData[0]) && $separadorData[0] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_titulo">
						<?php esc_html_e( 'Título sección', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_titulo" id="jrojas_home_titulo" value="<?php echo isset($separadorData[1]) ? esc_attr( $separadorData[1]) : ''; ?>"/>
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_separador_texto_boton">
						<?php esc_html_e( 'Texto Boton', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_separador_texto_boton" id="jrojas_home_separador_texto_boton" value="<?php echo isset($separadorData[2]) ? esc_attr( $separadorData[2]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_separador_link_boton">
						<?php esc_html_e( 'Url Boton', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_separador_link_boton" id="jrojas_home_separador_link_boton" value="<?php echo isset($separadorData[3]) ? esc_attr( $separadorData[3]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_home_separador_target_boton"><?php esc_html_e( 'Abrir en nueva pestaña', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_home_separador_target_boton" id="jrojas_home_separador_target_boton" value="<?php echo isset($separadorData[4]) ? esc_attr( $separadorData[4]) : '' ?>" <?php if (isset($separadorData[4]) && $separadorData[4] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_home_separador_texto_bloque"><?php esc_html_e( 'Texto del bloque', 'jrojas' ); ?></label>	
					<textarea name="jrojas_home_separador_texto_bloque" id="jrojas_home_separador_texto_bloque"><?php echo isset($separadorData[5]) ?  esc_textarea($separadorData[5]) : '' ?></textarea>
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_separador_imagen">
						<?php esc_html_e( 'Imagen', 'jrojas' ); ?>
					</label>
					<input type="text" name="jrojas_home_separador_imagen" id="jrojas_home_separador_imagen" value="<?php echo isset($separadorData[6]) ? esc_attr( $separadorData[6]) : ''; ?>"/>
					<button type="button" class="upload-images button-primary">Agregar imagen</button>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_separador_imagen_movil">
						<?php esc_html_e( 'Imagen Movil', 'jrojas' ); ?>
					</label>
					<input type="text" name="jrojas_home_separador_imagen_movil" id="jrojas_home_separador_imagen_movil" value="<?php echo isset($separadorData[7]) ? esc_attr( $separadorData[7]) : ''; ?>"/>
					<button type="button" class="upload-images button-primary">Agregar imagen</button>		
				</div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_home_separador' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_home_separador()
	 */
    function jrojas_save_metabox_home_separador( $post_id, WP_Post $post ) {
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_home_separador_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_home_separador_nonce'], 'jrojas_home_separador' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataSeparador = array();
		
		array_push($dataSeparador, esc_attr( $_POST['jrojas_home_separador'] ) );
		array_push($dataSeparador, sanitize_text_field( $_POST['jrojas_home_titulo'] ) );
		array_push($dataSeparador, sanitize_text_field( $_POST['jrojas_home_separador_texto_boton'] ) );
		array_push($dataSeparador, esc_url( $_POST['jrojas_home_separador_link_boton'] ) );
		array_push($dataSeparador, esc_attr( isset( $_POST['jrojas_home_separador_target_boton'] ) ? $_POST['jrojas_home_separador_target_boton'] : '0' ) );
		array_push($dataSeparador, sanitize_textarea_field( $_POST['jrojas_home_separador_texto_bloque'] ) );
		array_push($dataSeparador, esc_url( $_POST['jrojas_home_separador_imagen'] ) );
		array_push($dataSeparador, esc_url( $_POST['jrojas_home_separador_imagen_movil'] ) );
		
        if ( ! empty( $dataSeparador ) ) {
        	update_post_meta( $post_id, '_jrojas_home_separador', $dataSeparador );
        }
    
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_home_separador', 10, 2 );


/*------------------
* METABOX 11: ACTIVAR CURSOS
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_home_cursos' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_home_cursos() {
		global $post;
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

		if( $pageTemplate == 'page-home.php' || $pageTemplate == 'admin/page-home.php' ) {
			add_meta_box(
				'home-cursos',
				__( 'Cursos Home', 'jrojas' ),
				'jrojas_add_metabox_home_cursos_callback',
				'page'
			);	
		}
        
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_home_cursos' );

if ( ! function_exists( 'jrojas_add_metabox_home_cursos_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_home_cursos()
	 */
    function jrojas_add_metabox_home_cursos_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_home_cursos', 'jrojas_home_cursos_nonce' );

        $metaDestinos = get_post_meta( $post->ID, '_jrojas_home_cursos', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Mostrar últimos cursos cargados' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
				<div class="metabox_input_data">
					<label for="jrojas_home_cursos"><?php esc_html_e( 'Activar Cursos', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_home_cursos" id="jrojas_home_cursos" value="<?php echo isset($metaDestinos[0]) ? esc_attr( $metaDestinos[0]) : '' ?>" <?php if (isset($metaDestinos[0]) && $metaDestinos[0] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_numeros_cursos">
						<?php esc_html_e( 'Número a mostrar', 'jrojas' ); ?>
					</label>
            		<input type="number" name="jrojas_home_numeros_cursos" id="jrojas_home_numeros_cursos" value="<?php echo isset($metaDestinos[1]) ? esc_attr( $metaDestinos[1]) : '10'; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_titulo_cursos">
						<?php esc_html_e( 'Título', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_titulo_cursos" id="jrojas_home_titulo_cursos" value="<?php echo isset($metaDestinos[2]) ? esc_attr( $metaDestinos[2]) : '10'; ?>"/>		
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_home_cursos_ver_mas"><?php esc_html_e( 'Botón Leer más', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_home_cursos_ver_mas" id="jrojas_home_cursos_ver_mas" value="<?php echo isset($metaDestinos[3]) ? esc_attr( $metaDestinos[3]) : '' ?>" <?php if (isset($metaDestinos[3]) && $metaDestinos[3] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_url_cursos">
						<?php esc_html_e( 'URL', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_url_cursos" id="jrojas_home_url_cursos" value="<?php echo isset($metaDestinos[4]) ? esc_attr( $metaDestinos[4]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_home_cursos_texto"><?php esc_html_e( 'Texto del bloque', 'jrojas' ); ?></label>	
					<textarea name="jrojas_home_cursos_texto" id="jrojas_home_cursos_texto"><?php echo isset($metaDestinos[5]) ?  esc_textarea($metaDestinos[5]) : '' ?></textarea>
				</div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_home_cursos' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_sliders()
	 */
    function jrojas_save_metabox_home_cursos( $post_id, WP_Post $post ) {
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_home_destinos_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_home_destinos_nonce'], 'jrojas_home_destinos' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataDestinos = array();

		array_push($dataDestinos, esc_attr( $_POST['jrojas_home_cursos'] ) );
		array_push($dataDestinos, esc_attr( $_POST['jrojas_home_numeros_cursos'] ) );
		array_push($dataDestinos, sanitize_text_field( $_POST['jrojas_home_titulo_cursos'] ) );
		array_push($dataDestinos, esc_attr( isset($_POST['jrojas_home_cursos_ver_mas']) ? $_POST['jrojas_home_cursos_ver_mas'] : '0' ) );
		array_push($dataDestinos, esc_url( $_POST['jrojas_home_url_cursos'] ) );
		array_push($dataDestinos, sanitize_textarea_field( $_POST['jrojas_home_cursos_texto'] ) );
		
		
        if ( ! empty( $dataDestinos ) ) {
        	update_post_meta( $post_id, '_jrojas_home_cursos', $dataDestinos );
        }
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_home_cursos', 10, 2 );


/*------------------
* METABOX 12: ALOJAMIENTO
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_home_alojamientos' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_home_alojamientos() {
		global $post;
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

		if( $pageTemplate == 'page-home.php' || $pageTemplate == 'admin/page-home.php' ) {
			add_meta_box(
				'home-alojamiento',
				__( 'Bloque Alojamiento', 'jrojas' ),
				'jrojas_add_metabox_home_alojamientos_callback',
				'page'
			);	
		}
        
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_home_alojamientos' );

if ( ! function_exists( 'jrojas_add_metabox_home_alojamientos_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_home_sliders()
	 */
    function jrojas_add_metabox_home_alojamientos_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_home_alojamientos', 'jrojas_home_alojamientos_nonce' );

        $alojamientoData = get_post_meta( $post->ID, '_jrojas_home_alojamientos', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Activar bloque de alojamiento y definir los datos y las imágenes.', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
				<div class="metabox_input_data">
					<label for="jrojas_home_alojamiento"><?php esc_html_e( 'Activar bloque alojamientos', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_home_alojamiento" id="jrojas_home_alojamiento" value="<?php echo isset($alojamientoData[0]) ? esc_attr( $alojamientoData[0]) : '' ?>" <?php if (isset($alojamientoData[0]) && $alojamientoData[0] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_alojamiento_titulo">
						<?php esc_html_e( 'Título sección', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_alojamiento_titulo" id="jrojas_home_alojamiento_titulo" value="<?php echo isset($alojamientoData[1]) ? esc_attr( $alojamientoData[1]) : ''; ?>"/>
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_alojamiento_mini_text">
						<?php esc_html_e( 'Mini texto', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_alojamiento_mini_text" id="jrojas_home_alojamiento_mini_text" value="<?php echo isset($alojamientoData[2]) ? esc_attr( $alojamientoData[2]) : ''; ?>"/>
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_alojamiento_texto_boton">
						<?php esc_html_e( 'Texto Boton', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_alojamiento_texto_boton" id="jrojas_home_alojamiento_texto_boton" value="<?php echo isset($alojamientoData[3]) ? esc_attr( $alojamientoData[3]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_alojamiento_link_boton">
						<?php esc_html_e( 'Url Boton', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_alojamiento_link_boton" id="jrojas_home_alojamiento_link_boton" value="<?php echo isset($alojamientoData[4]) ? esc_attr( $alojamientoData[4]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_home_alojamiento_target_boton"><?php esc_html_e( 'Abrir en nueva pestaña', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_home_alojamiento_target_boton" id="jrojas_home_alojamiento_target_boton" value="<?php echo isset($alojamientoData[5]) ? esc_attr( $alojamientoData[5]) : '' ?>" <?php if (isset($alojamientoData[5]) && $alojamientoData[5] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_home_alojamiento_texto_bloque"><?php esc_html_e( 'Texto del bloque', 'jrojas' ); ?></label>	
					<textarea name="jrojas_home_alojamiento_texto_bloque" id="jrojas_home_alojamiento_texto_bloque"><?php echo isset($alojamientoData[6]) ?  esc_textarea($alojamientoData[6]) : '' ?></textarea>
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_alojamiento_imagen">
						<?php esc_html_e( 'Imagen', 'jrojas' ); ?>
					</label>
					<input type="text" name="jrojas_home_alojamiento_imagen" id="jrojas_home_alojamiento_imagen" value="<?php echo isset($alojamientoData[7]) ? esc_attr( $alojamientoData[7]) : ''; ?>"/>
					<button type="button" class="upload-images button-primary">Agregar imagen</button>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_alojamiento_imagen_movil">
						<?php esc_html_e( 'Imagen Movil', 'jrojas' ); ?>
					</label>
					<input type="text" name="jrojas_home_alojamiento_imagen_movil" id="jrojas_home_alojamiento_imagen_movil" value="<?php echo isset($alojamientoData[8]) ? esc_attr( $alojamientoData[8]) : ''; ?>"/>
					<button type="button" class="upload-images button-primary">Agregar imagen</button>		
				</div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_home_alojamientos' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_home_alojamientos()
	 */
    function jrojas_save_metabox_home_alojamientos( $post_id, WP_Post $post ) {
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_home_alojamientos_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_home_alojamientos_nonce'], 'jrojas_home_alojamientos' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataAlojamiento = array();
		
		array_push($dataAlojamiento, esc_attr( isset($_POST['jrojas_home_alojamiento']) ? $_POST['jrojas_home_alojamiento'] : '' ) );
		array_push($dataAlojamiento, sanitize_text_field( $_POST['jrojas_home_alojamiento_titulo'] ) );
		array_push($dataAlojamiento, sanitize_text_field( $_POST['jrojas_home_alojamiento_mini_text'] ) );
		array_push($dataAlojamiento, sanitize_text_field( $_POST['jrojas_home_alojamiento_texto_boton'] ) );
		array_push($dataAlojamiento, esc_url( $_POST['jrojas_home_alojamiento_link_boton'] ) );
		array_push($dataAlojamiento, esc_attr( $_POST['jrojas_home_alojamiento_target_boton'] ) );
		array_push($dataAlojamiento, sanitize_textarea_field( $_POST['jrojas_home_alojamiento_texto_bloque'] ) );
		array_push($dataAlojamiento, esc_url( $_POST['jrojas_home_alojamiento_imagen'] ) );
		array_push($dataAlojamiento, esc_url( $_POST['jrojas_home_alojamiento_imagen_movil'] ) );
		
        if ( ! empty( $dataAlojamiento ) ) {
        	update_post_meta( $post_id, '_jrojas_home_alojamientos', $dataAlojamiento );
        }
    
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_home_alojamientos', 10, 2 );


/*------------------
* METABOX 13: TESTIMONIO
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_home_testimonios' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_home_testimonios() {
		global $post;
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

		if( $pageTemplate == 'page-home.php' || $pageTemplate == 'admin/page-home.php' ) {
			add_meta_box(
				'home-testimonios',
				__( 'Testimonios Home', 'jrojas' ),
				'jrojas_add_metabox_home_testimonios_callback',
				'page'
			);	
		}
        
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_home_testimonios' );

if ( ! function_exists( 'jrojas_add_metabox_home_testimonios_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_home_cursos()
	 */
    function jrojas_add_metabox_home_testimonios_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_home_testimonios', 'jrojas_home_testimonios_nonce' );

        $metaTestimonios = get_post_meta( $post->ID, '_jrojas_home_testimonios', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Mostrar últimos testimonios cargados' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
				<div class="metabox_input_data">
					<label for="jrojas_home_testimonios"><?php esc_html_e( 'Activar Testimonios', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_home_testimonios" id="jrojas_home_testimonios" value="<?php echo isset($metaTestimonios[0]) ? esc_attr( $metaTestimonios[0]) : '' ?>" <?php if (isset($metaTestimonios[0]) && $metaTestimonios[0] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_numeros_testimonios">
						<?php esc_html_e( 'Número a mostrar', 'jrojas' ); ?>
					</label>
            		<input type="number" name="jrojas_home_numeros_testimonios" id="jrojas_home_numeros_testimonios" value="<?php echo isset($metaTestimonios[1]) ? esc_attr( $metaTestimonios[1]) : '10'; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_home_titulo_testimonios">
						<?php esc_html_e( 'Título', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_home_titulo_testimonios" id="jrojas_home_titulo_testimonios" value="<?php echo isset($metaTestimonios[2]) ? esc_attr( $metaTestimonios[2]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_home_testimonios_texto"><?php esc_html_e( 'Texto del bloque', 'jrojas' ); ?></label>	
					<textarea name="jrojas_home_testimonios_texto" id="jrojas_home_testimonios_texto"><?php echo isset($metaTestimonios[3]) ?  esc_textarea($metaTestimonios[3]) : '' ?></textarea>
				</div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_home_testimonios' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_sliders()
	 */
    function jrojas_save_metabox_home_testimonios( $post_id, WP_Post $post ) {
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_home_testimonios_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_home_testimonios_nonce'], 'jrojas_home_testimonios' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataTestimonios = array();

		array_push($dataTestimonios, esc_attr( $_POST['jrojas_home_testimonios'] ) );
		array_push($dataTestimonios, esc_attr( $_POST['jrojas_home_numeros_testimonios'] ) );
		array_push($dataTestimonios, sanitize_text_field( $_POST['jrojas_home_titulo_testimonios'] ) );
		array_push($dataTestimonios, sanitize_textarea_field( $_POST['jrojas_home_testimonios_texto'] ) );
		
		
        if ( ! empty( $dataTestimonios ) ) {
        	update_post_meta( $post_id, '_jrojas_home_testimonios', $dataTestimonios );
        }
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_home_testimonios', 10, 2 );


/*------------------
* METABOX 14: HOME CONTACTO
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_contact_form_code' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_contact_form_code() {

		global $post;
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

		if( $pageTemplate == 'page-home.php' || $pageTemplate == 'admin/page-home.php' ) {
			add_meta_box(
				'contact-form-code',
				__( 'Formulario de contacto:', 'jrojas' ),
				'jrojas_add_metabox_contact_form_code_callback',
				'page'
			);
		}

    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_contact_form_code' );

if ( ! function_exists( 'jrojas_add_metabox_contact_form_code_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_contact_form_code()
	 */
	function jrojas_add_metabox_contact_form_code_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_contact_form_code', 'jrojas_contact_form_code_nonce' );

        $metaContactFormCode = get_post_meta( $post->ID, '_jrojas_home_contacto', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Agregar el código de Contact Form 7, título y texto.', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
				<div class="metabox_input_data">
					<label for="jrojas_contact_code"><?php esc_html_e( 'Activar bloque Contacto', 'jrojas' ); ?></label>	
					<input class="input-checkbox" type="checkbox" name="jrojas_contact_code" id="jrojas_contact_code" value="<?php echo isset($metaContactFormCode[0]) ? esc_attr( $metaContactFormCode[0]) : '' ?>" <?php if (isset($metaContactFormCode[0]) && $metaContactFormCode[0] == '1') {echo 'checked'; } ?>/>	
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_contact_code_titulo">
						<?php esc_html_e( 'Título', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_contact_code_titulo" id="jrojas_contact_code_titulo" value="<?php echo isset($metaContactFormCode[1]) ? esc_attr( $metaContactFormCode[1]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
					<label for="jrojas_contact_code_titulo_texto"><?php esc_html_e( 'Texto del bloque', 'jrojas' ); ?></label>	
					<?php wp_editor( isset($metaContactFormCode[2]) ? $metaContactFormCode[2] : '', 'jrojas_contact_code_titulo_texto', array('media_buttons' => false,  )); ?>
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_contact_code_shortcode">
						<?php esc_html_e( 'Código Formulario', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_contact_code_shortcode" id="jrojas_contact_code_shortcode" value="<?php echo isset($metaContactFormCode[3]) ? esc_attr( $metaContactFormCode[3]) : ''; ?>"/>		
				</div>
			</div>
        </div>
		<?php
	

    }
}

if ( ! function_exists( 'jrojas_save_metabox_contact_form_code' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_contact_form_code()
	 */
    function jrojas_save_metabox_contact_form_code( $post_id, WP_Post $post ) {
       		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_contact_form_code_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_contact_form_code_nonce'], 'jrojas_contact_form_code' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataContacto = array();
		array_push($dataContacto, esc_attr( $_POST['jrojas_contact_code'] ) );
		array_push($dataContacto, sanitize_text_field( $_POST['jrojas_contact_code_titulo'] ) );
		array_push($dataContacto, $_POST['jrojas_contact_code_titulo_texto'] );
		array_push($dataContacto, wp_kses( $_POST['jrojas_contact_code_shortcode'], $allowedposttags = array(
			'h1'         => array(
				'align' => true,
				),
				'h2'         => array(
				'align' => true,
				),
				'h3'         => array(
				'align' => true,
				),
				'h4'         => array(
				'align' => true,
				),
				'h5' => array(
				'align' => true,
				),
				'h6'         => array(
				'align' => true,
				),
				'p'          => array(
					'align'    => true,
					'dir'      => true,
					'lang'     => true,
					'xml:lang' => true,
					),
		) ) );
		
        if ( ! empty( $dataContacto ) ) {
        	update_post_meta( $post_id, '_jrojas_home_contacto', $dataContacto );
        }

 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_contact_form_code', 10, 2 );


/*------------------
* METABOX 7: SELECCIONAR PROGRAMAS
-------------------*/

if ( ! function_exists( 'jrojas_metabox_home_programas' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_metabox_home_programas() {

		global $post;
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

		if( $pageTemplate == 'page-home.php' || $pageTemplate == 'admin/page-home.php' ) {

			add_meta_box(
				'home_programas',
				__( 'Programas:', 'jrojas' ),
				'jrojas_metabox_home_programas_callback',
				'page'
			);
		}
    }
}

add_action( 'add_meta_boxes', 'jrojas_metabox_home_programas' );

if ( ! function_exists( 'jrojas_metabox_home_programas_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_metabox_home_programas()
	 */
    function jrojas_metabox_home_programas_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_metabox_home_programas_callback', 'jrojas_metabox_home_programas_callback_nonce' );

		$programasSelected = get_post_meta( $post->ID, '_jrojas_meta_home_programas', true );
		
		?>

		<div class="jrojas_metabox_wrapper">
			<input type="hidden" name="home_programas_id" id="home_programas_id" value="<?php echo isset($programasSelected[5]) ? $programasSelected[5] : ''; ?>">
			<?php 
			//busca programas cargados
			$programas = new WP_Query( array(
				'post_type' => 'programas',
				)
			);
			if ($programas->have_posts()) : ?>

				<p>
					<?php _e('Activar el bloque, definir boton y url.', 'jrojas' ); ?>
				</p>
				
				<div class="jrojas_metabox_input_data_wrapper">

					<div class="metabox_input_data">
						<label for="jrojas_home_activar_programa"><?php esc_html_e( 'Activar Programas', 'jrojas' ); ?></label>
						<input class="input-checkbox" type="checkbox" name="jrojas_home_activar_programa" id="jrojas_home_activar_programa" value="<?php echo isset($programasSelected[0]) ? esc_attr( $programasSelected[0]) : '' ?>" <?php if (isset($programasSelected[0]) && $programasSelected[0] == '1') {echo 'checked'; } ?>/>
					</div>

					<div class="metabox_input_data">
						<label for="jrojas_home_programas_titulo"><?php esc_html_e( 'Título bloque', 'jrojas' ); ?></label>
						<input type="text" id="jrojas_home_programas_titulo" name="jrojas_home_programas_titulo" value="<?php echo isset($programasSelected[1]) ? sanitize_text_field( $programasSelected[1]) : '' ?>">
					</div>

					<div class="metabox_input_data">
						<label for="jrojas_home_programas_texto"><?php esc_html_e( 'Texto del bloque', 'jrojas' ); ?></label>	
						<textarea name="jrojas_home_programas_texto" id="jrojas_home_programas_texto"><?php echo isset($programasSelected[2]) ?  esc_textarea($programasSelected[2]) : '' ?></textarea>
					</div>

					<div class="metabox_input_data">
						<label for="jrojas_home_programa_leermas"><?php esc_html_e( 'Botón Leer más', 'jrojas' ); ?></label>
						<input class="input-checkbox" type="checkbox" name="jrojas_home_programa_leermas" id="jrojas_home_programa_leermas" value="<?php echo isset($programasSelected[3]) ? esc_attr( $programasSelected[3]) : '' ?>" <?php if (isset($programasSelected[3]) && $programasSelected[3] == '1') {echo 'checked'; } ?>/>
					</div>
					<div class="metabox_input_data">
						<label for="jrojas_home_programas_url"><?php esc_html_e( 'Url', 'jrojas' ); ?></label>
						<input type="text" id="jrojas_home_programas_url" name="jrojas_home_programas_url" value="<?php echo isset($programasSelected[4]) ? esc_url( $programasSelected[4]) : '' ?>">
					</div>

					<h4 class="title-destacado-metabox">
						<?php _e('Seleccionar programas para mostrar.', 'jrojas' ); ?>
					</h4>
					<?php while ( $programas->have_posts() ) : $programas->the_post();
						$nombre = get_the_title();
						$id = get_the_id();
						$resumen = get_the_excerpt();
						?>
						<div class="metabox_input_data">
							<input type="checkbox" class="input-checkbox input_programas" name="programas_id" data-id="<?php echo $id; ?>"<?php if ( strpos($programasSelected[5], $id.',') !== false ) { echo ' checked'; }?>>
							<label for="programas_id">
								<?php echo $nombre; ?>
							</label>
						</div>

					<?php endwhile; ?>
			</div>

		<?php else : ?>

			<p>
				<?php _e('No hay ningún programa cargado.', 'jrojas' ); ?>
			</p>

		<?php endif; ?>
		
		</div>
		
		<?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_home_programas' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_metabox_home_programas_callback()
	 */
    function jrojas_save_metabox_home_programas( $post_id, WP_Post $post ) {
       		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_metabox_home_programas_callback_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_metabox_home_programas_callback_nonce'], 'jrojas_metabox_home_programas_callback' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		
	    $programasSelected = array();

		array_push($programasSelected, isset($_POST['jrojas_home_activar_programa']) ? esc_attr($_POST['jrojas_home_activar_programa']) : '' );
		array_push($programasSelected, isset($_POST['jrojas_home_programas_titulo']) ? sanitize_text_field($_POST['jrojas_home_programas_titulo']) : '' );
		array_push($programasSelected, isset($_POST['jrojas_home_programas_texto']) ? sanitize_text_field($_POST['jrojas_home_programas_texto']) : '' );
		array_push($programasSelected, isset($_POST['jrojas_home_programa_leermas']) ? esc_attr($_POST['jrojas_home_programa_leermas']) : '' );
		array_push($programasSelected, isset($_POST['jrojas_home_programas_url']) ? esc_url($_POST['jrojas_home_programas_url']) : '' );
		array_push($programasSelected, isset($_POST['home_programas_id']) ? esc_attr($_POST['home_programas_id']) : '' );


		if ( !empty( $programasSelected ) ) {
			update_post_meta( $post_id, '_jrojas_meta_home_programas', $programasSelected );
		}

 	}
}

add_action( 'save_post', 'jrojas_save_metabox_home_programas', 10, 2 );