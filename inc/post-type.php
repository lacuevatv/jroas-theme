<?php
/**
 * Manage post type, taxonomies and metaboxes.
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 */
 
 // If this file is called directly, abort.
 if ( ! defined( 'WPINC' ) ) {
 	die;
 }

/**
 * REGISTER POST TYPE
 * 
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 * 
 * 1.Partners: logos footer. Imagen, titulo
 * 2. Testimonios: Imagen, titulo (nombre), editor.
 * 3. Sliders
 * 4. Crew
 * 5. Destinos
 * 6. Cursos
 * 7. Alojamientos
 * 8. Programas
 * 
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
*/
if ( !function_exists( 'jrojas_create_post_type' ) ) :
    function jrojas_create_post_type () {
        /*
         * SLIDERS POST TYPE 
        */
        register_post_type ( 'sliders', array (
            'labels'       => array(
                'name'          => __( 'sliders', 'jrojas' ),
                'singular_name' => __( 'slider', 'jrojas' ),
            ),
            'supports'      => array (
                'title', 'excerpt',
            ),
            'public'      => true,
            'has_archive' => false,
            //'register_meta_box_cb' => 'jrojas_meta_box_sliders',
            'show_in_nav_menus' => false,
            'menu_icon'   => 'dashicons-desktop'
            )
        );

        /*
         * AGENDA POST TYPE 
        */
        register_post_type ( 'agenda', array (
            'labels'       => array(
                'name'          => __( 'agenda', 'jrojas' ),
                'singular_name' => __( 'fecha', 'jrojas' ),
            ),
            'supports'      => array (
                'title', 'excerpt', 'editor'
            ),
            'public'      => true,
            'has_archive' => false,
            //'register_meta_box_cb' => 'jrojas_meta_box_agenda',
            'show_in_nav_menus' => false,
            'menu_icon'   => 'dashicons-calendar-alt'
            )
        );

        /*
         * GALERIA POST TYPE 
        */
        register_post_type ( 'galeria', array (
            'labels'       => array(
                'name'          => __( 'galeria', 'jrojas' ),
                'singular_name' => __( 'galeria', 'jrojas' ),
            ),
            'supports'      => array (
                'title', 'excerpt'
            ),
            'public'      => true,
            'has_archive' => false,
            //'register_meta_box_cb' => 'jrojas_meta_box_galeria',
            'show_in_nav_menus' => false,
            'menu_icon'   => 'dashicons-images-alt'
            )
        );

        /*
         * OBRAS POST TYPE 
        */
        register_post_type ( 'obras', array (
            'labels'       => array(
                'name'          => __( 'obras', 'jrojas' ),
                'singular_name' => __( 'obra', 'jrojas' ),
            ),
            'supports'      => array (
                'title', 'editor'
            ),
            'public'      => true,
            'has_archive' => false,
            //'register_meta_box_cb' => 'jrojas_meta_box_obras',
            'show_in_nav_menus' => false,
            'menu_icon'   => 'dashicons-playlist-audio'
            )
        );

        

    }//jrojas_create_post_type()
    
endif;

add_action( 'init', 'jrojas_create_post_type', 20 );

/**
 * Register privates taxonomies for post type abobe
 *
 * @see register_post_type() for registering post types.
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 * 
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 */
/*if ( !function_exists( 'jrojas_register_private_taxonomy' ) ) :
    function jrojas_register_private_taxonomy () {
         
        /**
         * CATEGORIA ALOJAMIENTOS
        */
        /*register_taxonomy( 'catalojamientos', 'alojamientos', array(
            'label'        => __( 'Categorías de Alojamientos', 'jrojas' ),
            'public'       => true,
            'rewrite'      => false,
            'hierarchical' => true,
            'show_in_nav_menus' => false,
            )
        );
        
    }
endif;

add_action( 'init', 'jrojas_register_private_taxonomy' );*/

// funciones generales //

/**
 * Reset rewrite rules for reentrly added post type and taxonomies.
 *
 * @since 1.0
 */
if ( ! function_exists( 'jrojas_flush_rewrite_rules' ) ) :
    add_action( 'init', 'jrojas_flush_rewrite_rules', 90 );

function jrojas_flush_rewrite_rules() {
	if ( ! get_option( 'jrojas_flushed_rewrite_rules' ) ) {
		flush_rewrite_rules();
		add_option( 'jrojas_flushed_rewrite_rules', true );
	}
}
endif;