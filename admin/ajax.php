<?php
/**
 * AJAX file
 *
 * @link https://codex.wordpress.org/AJAX_in_Plugins
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
 
if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) :

    add_action( 'wp_ajax_formulario_contacto', 'formulario_contacto_cb' );
    add_action( 'wp_ajax_nopriv_formulario_contacto', 'formulario_contacto_cb' );

    if ( ! function_exists( 'formulario_contacto_cb' ) ) :

        function formulario_contacto_cb() {
            
            var_dump($_POST);
        }

    endif;
    

endif; //doing ajax