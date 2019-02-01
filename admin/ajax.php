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
            
            //var_dump($_POST);

            $formulario = isset($_POST['formulario']) ? $_POST['formulario'] : '';
            

            switch ( $formulario ) {
                case 'suscripcion':
        
                    //$emailTo = 'info@jorgerojas.info';
                    $emailTo = 'bnutkowicz@portinos.com.ar ';
                    $nombreTo = 'Jorge Rojas';
                    $asunto = 'Nueva Suscripción';
                    $nombre = isset($_POST['name']) ? $_POST['name'] : '';
                    $email = isset($_POST['email']) ? $_POST['email'] : '';
                    $contenido = '<h2>Formulario suscripción</h2><p>Nombre: '.$nombre.'<br>Email: '.$email.'</p>';
        
                    //FUNCION QUE ENVIA FORMULARIO CON PHPMAILER			
                    echo sendEmailPhpMailer( $email, $nombre, $emailTo, $nombreTo, $asunto, $contenido);
        
                break;

                case 'contacto':
        
                    //$emailTo = 'info@jorgerojas.info';
                    $emailTo = 'bnutkowicz@portinos.com.ar ';
                    $nombreTo = 'Jorge Rojas';
                    $asunto = 'Formulario contacto';
                    $nombre = isset($_POST['name']) ? $_POST['name'] : '';
                    $email = isset($_POST['email']) ? $_POST['email'] : '';
                    $msj = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';
                    $contenido = '<h2>Formulario Contacto</h2><p>Nombre: '.$nombre.'<br>Email: '.$email.'<br>Mensaje: '.$msj.'</p>';
        
                    //FUNCION QUE ENVIA FORMULARIO CON PHPMAILER			
                    echo sendEmailPhpMailer( $email, $nombre, $emailTo, $nombreTo, $asunto, $contenido);
        
                break;

                case 'contratacion':
        
                    //$emailTo = 'info@jorgerojas.info';
                    $emailTo = 'bnutkowicz@portinos.com.ar ';
                    $nombreTo = 'Jorge Rojas';
                    $asunto = 'Formulario contratación';
                    $nombre = isset($_POST['name']) ? $_POST['name'] : '';
                    $email = isset($_POST['email']) ? $_POST['email'] : '';
                    $msj = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';
                    $contenido = '<h2>Formulario Contacto</h2><p>Nombre: '.$nombre.'<br>Email: '.$email.'<br>Mensaje: '.$msj.'</p>';
        
                    //FUNCION QUE ENVIA FORMULARIO CON PHPMAILER			
                    echo sendEmailPhpMailer( $email, $nombre, $emailTo, $nombreTo, $asunto, $contenido);
        
                break;
        
            }

        exit;
        }

    endif;
    

endif; //doing ajax