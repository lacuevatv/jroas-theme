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
* METABOX 1: SLIDERS
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
        		<?php _e('Agregar imagen texto del boton y url.', 'jrojas' ); ?>
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
            		<input type="text" name="jrojas_btn_sliders" id="jrojas_btn_sliders" value="<?php echo isset($metaSliders[1]) ? esc_attr( $metaSliders[1]) : _e( 'Ver más','jrojas'); ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_open_sliders">
						<?php esc_html_e( 'Abrir en ventana nueva', 'jrojas' ); ?>
					</label>
            		<input type="checkbox" class="input-checkbox" name="jrojas_open_sliders" id="jrojas_open_sliders"  <?php isset( $metaSliders[2] ) ? checked( $metaSliders[2], 'on' ) : 'off'; ?>/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_imagen_sliders">
						<?php esc_html_e( 'Imagen', 'jrojas' ); ?>
					</label>
					<input type="text" name="jrojas_imagen_sliders" id="jrojas_url_sliders" value="<?php echo isset($metaSliders[3]) ? esc_attr( $metaSliders[3]) : ''; ?>"/>
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
		$datos_sumados = $dato1 + $dato2 + $dato3 + $dato4;
		
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
		
        if ( ! empty( $dataSlider ) ) {
        	update_post_meta( $post_id, '_jrojas_sliders', $dataSlider );
        }
        
        
        
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_sliders', 10, 2 );



/*------------------
* METABOX 2: GALERIA
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_galeria' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_galeria() {
        add_meta_box(
            'datos-adicionales',
            __( 'Datos Adicionales', 'jrojas' ),
            'jrojas_add_metabox_galeria_callback',
			'galeria'
        );
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_galeria' );

if ( ! function_exists( 'jrojas_add_metabox_galeria_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_galeria()
	 */
    function jrojas_add_metabox_galeria_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_galeria', 'jrojas_galeria_nonce' );

        $metagaleria = get_post_meta( $post->ID, '_jrojas_galeria', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Agregar imagen o url del video.', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
        		<div class="metabox_input_data">
	            	<label for="jrojas_url_galeria">
						<?php esc_html_e( 'Url Video', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_url_galeria" id="jrojas_url_galeria" value="<?php echo isset($metagaleria[0]) ? esc_attr( $metagaleria[0]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_imagen_galeria">
						<?php esc_html_e( 'Imagen', 'jrojas' ); ?>
					</label>
					<input type="text" name="jrojas_imagen_galeria" id="jrojas_url_galeria" value="<?php echo isset($metagaleria[1]) ? esc_attr( $metagaleria[1]) : ''; ?>"/>
					<button type="button" class="upload-images button-primary">Agregar imagen</button>		
				</div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_galeria' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_galeria()
	 */
    function jrojas_save_metabox_galeria( $post_id, WP_Post $post ) {
        // Si no se reciben los datos o no hay ninguno, salir de la función.
		$dato1 = isset( $_POST['jrojas_url_galeria'] ) ? 1 : 0;
		$dato2 = isset( $_POST['jrojas_btn_galeria'] ) ? 1 : 0;
		$datos_sumados = $dato1 + $dato2;
		
		if ( $datos_sumados == 0  ) {
            return;
        };
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_galeria_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_galeria_nonce'], 'jrojas_galeria' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataSlider = array();
		array_push($dataSlider, esc_url( $_POST['jrojas_url_galeria'] ) );
		array_push($dataSlider, esc_url( $_POST['jrojas_imagen_galeria'] ) );
		
        if ( ! empty( $dataSlider ) ) {
        	update_post_meta( $post_id, '_jrojas_galeria', $dataSlider );
        }
        
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_galeria', 10, 2 );



/*------------------
* METABOX 3: AGENDA
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_agenda' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_agenda() {
        add_meta_box(
            'datos-adicionales',
            __( 'Datos Adicionales', 'jrojas' ),
            'jrojas_add_metabox_agenda_callback',
			'agenda'
        );
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_agenda' );

if ( ! function_exists( 'jrojas_add_metabox_agenda_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_agenda()
	 */
    function jrojas_add_metabox_agenda_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_agenda', 'jrojas_agenda_nonce' );

        $metaagenda = get_post_meta( $post->ID, '_jrojas_agenda', true );
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Agregar fecha y lugar.', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
				<div class="metabox_input_data">
	            	<label for="jrojas_lugar">
						<?php esc_html_e( 'Lugar', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_lugar" id="jrojas_lugar" value="<?php echo isset($metaagenda[0]) ? esc_attr( $metaagenda[0]) : ''; ?>"/>		
				</div>
			</div>
			<div class="jrojas_metabox_input_data_wrapper">
				<div class="metabox_input_data">
	            	<label for="jrojas_fecha">
						<?php esc_html_e( 'Fecha', 'jrojas' ); ?>
					</label>
            		<input type="date" name="jrojas_fecha" id="jrojas_fecha" value="<?php echo isset($metaagenda[1]) ? esc_attr( $metaagenda[1]) : ''; ?>"/>		
				</div>
            </div>
        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_agenda' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_agenda()
	 */
    function jrojas_save_metabox_agenda( $post_id, WP_Post $post ) {
        // Si no se reciben los datos o no hay ninguno, salir de la función.
		$dato1 = isset( $_POST['jrojas_lugar'] ) ? 1 : 0;
		$dato2 = isset( $_POST['jrojas_fecha'] ) ? 1 : 0;
		$datos_sumados = $dato1 + $dato2;
		
		if ( $datos_sumados == 0  ) {
            return;
        };
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_agenda_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_agenda_nonce'], 'jrojas_agenda' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataSlider = array();
		array_push($dataSlider, sanitize_text_field( $_POST['jrojas_lugar'] ) );
		array_push($dataSlider, sanitize_text_field( $_POST['jrojas_fecha'] ) );
		
        if ( ! empty( $dataSlider ) ) {
        	update_post_meta( $post_id, '_jrojas_agenda', $dataSlider );
        }
        
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_agenda', 10, 2 );


/*------------------
* METABOX 3: OBRAS
-------------------*/

if ( ! function_exists( 'jrojas_add_metabox_obras' ) ) {
	/**
	 * Register custom meta boxes for product. Section: header.
	 *
	 * @since 1.0
	 *
	 * @uses add_meta_box()
	 */
    function jrojas_add_metabox_obras() {
        add_meta_box(
            'datos-adicionales',
            __( 'Datos Adicionales', 'jrojas' ),
            'jrojas_add_metabox_obras_callback',
			'obras'
        );
    }
}

add_action( 'add_meta_boxes', 'jrojas_add_metabox_obras' );

if ( ! function_exists( 'jrojas_add_metabox_obras_callback' ) ) {
	/**
	 * Print HTML for meta box.
	 *
	 * @since 1.0
	 *
	 * @param WP_Post $post
	 *
	 * @see jrojas_add_metabox_obras()
	 */
    function jrojas_add_metabox_obras_callback( WP_Post $post ) {
        wp_nonce_field( 'jrojas_obras', 'jrojas_obras_nonce' );

		$metaobras = get_post_meta( $post->ID, '_jrojas_obras', true );
		var_dump($metaobras[5]);
        ?>

        <div class="jrojas_metabox_wrapper">
        	<p>
        		<?php _e('Agregar canciones, url de compra, lista de reproducciones.', 'jrojas' ); ?>
        	</p>

        	<div class="jrojas_metabox_input_data_wrapper">
				<div class="metabox_input_data">
	            	<label for="jrojas_fecha">
						<?php esc_html_e( 'Fecha disco', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_fecha" id="jrojas_fecha" value="<?php echo isset($metaobras[0]) ? esc_attr( $metaobras[0]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_url_compra">
						<?php esc_html_e( 'Url Compra', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_url_compra" id="jrojas_url_compra" value="<?php echo isset($metaobras[1]) ? esc_attr( $metaobras[1]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_url_spotify">
						<?php esc_html_e( 'Url Spotify', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_url_spotify" id="jrojas_url_spotify" value="<?php echo isset($metaobras[2]) ? esc_attr( $metaobras[2]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_url_apple">
						<?php esc_html_e( 'Url Apple', 'jrojas' ); ?>
					</label>
            		<input type="text" name="jrojas_url_apple" id="jrojas_url_apple" value="<?php echo isset($metaobras[3]) ? esc_attr( $metaobras[3]) : ''; ?>"/>		
				</div>
				<div class="metabox_input_data">
	            	<label for="jrojas_imagen_disco">
						<?php esc_html_e( 'Imagen', 'jrojas' ); ?>
					</label>
					<input type="text" name="jrojas_imagen_disco" id="jrojas_url_disco" value="<?php echo isset($metaobras[4]) ? esc_attr( $metaobras[4]) : ''; ?>"/>
					<button type="button" class="upload-images button-primary">Agregar imagen</button>		
				</div>

				<div class="metabox_input_data">
					<input type="hidden" name="jrojas_canciones" id="jrojas_canciones" value="<?php echo isset($metaobras[5]) ?  esc_attr($metaobras[5]) : ''; ?>"/>
				</div>
				
				<div class="wrapper-galeria-admin-metabox">
					<button type="button" class="button-primary agregar-cancion">
						Agregar canción
					</button>
					<p><small>
						Para ordenar las canciones arrastre los elementos.
					</small></p>
					<ul class="lista-canciones">
					</ul>
				</div>

			</div>

        </div>
        <?php

    }
}

if ( ! function_exists( 'jrojas_save_metabox_obras' ) ) {
	/**
	 * Save meta data for a post.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 *
	 * @since 1.0
	 * @see jrojas_add_metabox_obras()
	 */
    function jrojas_save_metabox_obras( $post_id, WP_Post $post ) {
        // Si no se reciben los datos o no hay ninguno, salir de la función.
		$dato1 = isset( $_POST['jrojas_fecha'] ) ? 1 : 0;
		$dato2 = isset( $_POST['jrojas_url_compra'] ) ? 1 : 0;
		$dato3 = isset( $_POST['jrojas_url_spotify'] ) ? 1 : 0;
		$dato4 = isset( $_POST['jrojas_url_apple'] ) ? 1 : 0;
		$dato5 = isset( $_POST['jrojas_imagen_disco'] ) ? 1 : 0;
		$dato6 = isset( $_POST['jrojas_canciones'] ) ? 1 : 0;
		$datos_sumados = $dato1 + $dato2 + $dato3 + $dato4 + $dato5 + $dato6;
		
		if ( $datos_sumados == 0  ) {
            return;
        };
		
        //si es un autosave salir de la funcion
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        	return;
        }

    	// Si no se aprueba el chequeo de seguridad, salir de la función.
	   if ( ! isset( $_POST['jrojas_obras_nonce'] ) || ! wp_verify_nonce( $_POST['jrojas_obras_nonce'], 'jrojas_obras' ) ) {
		  return;
	   }

        $post_type = get_post_type_object( $post->post_type );

        // Si el usuario actual no tiene permisos para modificar el post, salir de la función.
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
            return;
		}
		
        // Guardamos:
		$dataObras = array();
		array_push($dataObras, sanitize_text_field( $_POST['jrojas_fecha'] ) );
		array_push($dataObras, esc_url( $_POST['jrojas_url_compra'] ) );
		array_push($dataObras, esc_url( $_POST['jrojas_url_spotify'] ) );
		array_push($dataObras, esc_url( $_POST['jrojas_url_apple'] ) );
		array_push($dataObras, esc_url( $_POST['jrojas_imagen_disco'] ) );
		array_push($dataObras, $_POST['jrojas_canciones'] );
		
        if ( ! empty( $dataObras ) ) {
        	update_post_meta( $post_id, '_jrojas_obras', $dataObras );
        }
        
 	}   
}

add_action( 'save_post', 'jrojas_save_metabox_obras', 10, 2 );