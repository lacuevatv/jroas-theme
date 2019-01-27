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

    add_action( 'wp_ajax_get_data_galeria', 'get_data_galeria_cb' );
    add_action( 'wp_ajax_nopriv_get_data_galeria', 'get_data_galeria_cb' );

    if ( ! function_exists( 'get_data_galeria_cb' ) ) :

        function get_data_galeria_cb() {
            
            $respuesta = null;
            $arraysId = isset($_POST['ids']) ? $_POST['ids'] : array();
            $mainID = isset($_POST['mainId']) ? $_POST['mainId'] : '';
            $principalImage = array();
            $respuesta = array();

            if ( ! empty($arraysId ) && $mainID != ''  ) {
                $idslistados = array();

                //primero ubica la principal que es la que hizo click;
                $principalImage['id'] = $mainID;
                $principalImage['url'] = wp_get_attachment_image_src($mainID, 'full');

                array_push($idslistados, $mainID);  
                array_push($respuesta, $principalImage);

                foreach ( $arraysId as $id ) {

                    if ( $id != ''  && ! in_array($id, $idslistados) ) {
                        $res['id'] = $id;
                        $res['url'] = wp_get_attachment_image_src($id, 'full');

                        if ( $id == $mainID ) {
                            $res['active'] = true;
                        } else {
                            $res['active'] = false;
                        }

                        array_push($idslistados, $id);    

                        array_push($respuesta, $res);
                    }

                    
                }

            }
            
            if ( $respuesta == null ) {
                echo '0';
            } else {
                echo json_encode($respuesta);
            }
            wp_die();
        }

    endif;
    

endif; //doing ajax