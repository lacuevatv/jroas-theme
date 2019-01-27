<?php
/**
 * options file.
 * @link https://codex.wordpress.org/Function_Reference/add_options_page
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
if ( ! function_exists( 'jrojas_settings_page' ) ) :
    function jrojas_settings_page () {
        add_options_page(
		    //título que aparece en la página de opciones
			__('Opcionando el tema','jrojas'),
		    //texto que aparece en el link principal del menú
			__('jrojasPartners-settings','jrojas'),
		    //permisos del usuario
			'manage_options',
		    //string que identifica el menu internamente
			'jrojas_settings',
		    //funcion que imprime html
			'jrojas_settings_page_html'
		);
    }
endif;

add_action( 'admin_menu', 'jrojas_settings_page' );

function jrojas_settings_page_html() {
    ?>
    <div class="jrojas-settings-page">
		<h1><?php _e('jrojas Partners Theme - configuración', 'jrojas'); ?></h1>

		<form action="options.php" method="POST">
			<?php
			//imprime html necesario para las validaciones
				settings_fields( 'jrojas_settings_group' );
			?>
			<?php
			//imprime la seccion html del plugin y los campos asociados
				do_settings_sections('jrojas_settings');
			?>
			<?php
			//imprime el botón de confirmacion
				submit_button();
			?>
		</form>
	</div>

	<?php
}
function jrojas_settings_api_init() {
	//registramos la seccion
	add_settings_section(
        //tag 'id' de la seccion
        'jrojas-settings-admin-options',
        //título de la seccion
        __('jrojas Partners Theme opciones', 'jrojas'),
        //funcion que imprime el html de la seccion
        'jrojas_settings_section_callback_html',
        //slug del menu donde aparece la seccion
        'jrojas_settings'
    );
    
    //campo para agregar redes
	add_settings_field (
        //texto del tag 'id' del campo
        'jrojas-settings-admin-options-redes',
        //título del campo
        __('Datos de Contacto', 'jrojas'),
        //funcion que imprime el html del input
        'jrojas_settings_admin_html_redes',
        //slug del menu donde debe aparecer
        'jrojas_settings',
        //id de la seccion que pertenece
        'jrojas-settings-admin-options'
    );
    
    //campo para agregar imagen y texto superior
	add_settings_field (
        //texto del tag 'id' del campo
        'jrojas-settings-admin-options-head',
        //título del campo
        __('Logo', 'jrojas'),
        //funcion que imprime el html del input
        'jrojas_settings_admin_html_head',
        //slug del menu donde debe aparecer
        'jrojas_settings',
        //id de la seccion que pertenece
        'jrojas-settings-admin-options'
    );
    
    //campo para agregar redes sociales en el footer
	add_settings_field (
        //texto del tag 'id' del campo
        'jrojas-settings-admin-options-seguinos-footer',
        //título del campo
        __('Redes sociales', 'jrojas'),
        //funcion que imprime el html del input
        'jrojas_settings_admin_html_redes_footer',
        //slug del menu donde debe aparecer
        'jrojas_settings',
        //id de la seccion que pertenece
        'jrojas-settings-admin-options'
    );

    //campo para agregar redes sociales en el footer
	add_settings_field (
        //texto del tag 'id' del campo
        'jrojas-settings-admin-options-instagram-footer',
        //título del campo
        __('Instagram Feed Footer', 'jrojas'),
        //funcion que imprime el html del input
        'jrojas_settings_admin_html_instagram_footer',
        //slug del menu donde debe aparecer
        'jrojas_settings',
        //id de la seccion que pertenece
        'jrojas-settings-admin-options'
    );
    
	register_setting(
        //palabra clave igual que se uso en setting fields
        'jrojas_settings_group',
        //nombre de nuestra opcion dentro de la options API
        'jrojas_settings'
        //funcion que sanitiza las entradas
        //'minimal_settings_sanitize'
    );
}
add_action( 'admin_init', 'jrojas_settings_api_init' );
//callback para la seccion
function jrojas_settings_section_callback_html () {
    _e('Configurar los datos básicos aquí', 'jrojas');
}
//funciones que imprimen html de los campos de descripcion superior
function jrojas_settings_admin_html_head() {
    $jrojasSettings = get_option('jrojas_settings');
    $imagenLogoSVG = $jrojasSettings['jrojas_logo_svg'];
    $imagenLogo = $jrojasSettings['jrojas_logo'];
    
    ?>

    <!-- seccion header -->
    <div class="jrojas-settings-page-inputs">
        <label for="logo-jrojas-svg"><?php _e('Logo SVG', 'jrojas'); ?></label>
        <input id="logo-jrojas-svg" name="jrojas_settings[jrojas_logo_svg]" type="text" value="<?php echo isset($imagenLogoSVG) ? $imagenLogoSVG : ''; ?>">
        <button type="button" class="button-primary upload-logo-jrojas">Agregar imagen</button>
    </div>
    <div class="jrojas-settings-page-inputs">
        <label for="logo-jrojas"><?php _e('Logo', 'jrojas'); ?></label>
        <input id="logo-jrojas" name="jrojas_settings[jrojas_logo]" type="text" value="<?php echo isset($imagenLogo) ? $imagenLogo : ''; ?>">
        <button type="button" class="button-primary upload-logo-jrojas">Agregar imagen</button>
    </div>
<?php
}
//funciones que imprimen html de los campos de redes sociales
function jrojas_settings_admin_html_redes() {
    $jrojasSettings = get_option('jrojas_settings');
    $telContact = $jrojasSettings['jrojas_redes_tel'];
    //$emailContact = $jrojasSettings['jrojas_redes_email'];
    $facebookSB = $jrojasSettings['jrojas_redes_facebook'];
    $instagramSB = $jrojasSettings['jrojas_redes_instagram'];
	//$skypeSB = $jrojasSettings['jrojas_redes_skype'];
	//$twitterSB = $jrojasSettings['jrojas_redes_twitter'];
	//$googlePlusSB = $jrojasSettings['jrojas_redes_googleplus'];
	//$linkedinSB = $jrojasSettings['jrojas_redes_linkedin'];
	//$githubSB = $jrojasSettings['jrojas_redes_github'];
	//$pinterestSB = $jrojasSettings['jrojas_redes_pinterest'];
	//$behanceSB = $jrojasSettings['jrojas_redes_behance'];
	//$snapchatSB = $jrojasSettings['jrojas_redes_snapchat'];
	
	?>

    <!-- redes sociales -->
    <div class="jrojas-settings-page-inputs">
        <label for="telefono-redes-jrojas"><?php _e('Teléfono', 'jrojas'); ?></label>
        <input id="telefono-redes-jrojas" name="jrojas_settings[jrojas_redes_tel]" type="text" value="<?php echo $telContact; ?>">
    </div>

    <!--<div class="jrojas-settings-page-inputs">
        <label for="email-redes-jrojas"><?php //_e('Email', 'jrojas'); ?></label>
        <input id="email-redes-jrojas" name="jrojas_settings[jrojas_redes_email]" type="email" value="<?php echo $emailContact; ?>">
    </div>-->

    <div class="jrojas-settings-page-inputs">
        <label for="facebook-redes-jrojas"><?php _e('Facebook', 'jrojas'); ?></label>
        <input id="facebook-redes-jrojas" name="jrojas_settings[jrojas_redes_facebook]" type="url" value="<?php echo $facebookSB; ?>">
    </div>
    
    <div class="jrojas-settings-page-inputs">
        <label for="instagram-redes-jrojas"><?php _e('Instagram', 'jrojas'); ?></label>
        <input id="instagram-redes-jrojas" name="jrojas_settings[jrojas_redes_instagram]" type="url" value="<?php echo $instagramSB; ?>">
    </div>
    
    <div class="jrojas-settings-page-inputs">
        <!--<label for="skype-redes-jrojas"><?php //_e('Skype', 'jrojas'); ?></label>
        <input id="skype-redes-jrojas" name="jrojas_settings[jrojas_redes_skype]" type="text" value="<?php //echo $skypeSB; ?>">
    </div>
    
    <div class="jrojas-settings-page-inputs">
        <label for="twitter-redes-jrojas"><?php //_e('Twitter', 'jrojas'); ?></label>
        <input id="twitter-redes-jrojas" name="jrojas_settings[jrojas_redes_twitter]" type="url" value="<?php //echo $twitterSB; ?>">
    </div>
    
    <div class="jrojas-settings-page-inputs">
        <label for="googleplus-redes-jrojas"><?php //_e('Google Plus', 'jrojas'); ?></label>
        <input id="googleplus-redes-jrojas" name="jrojas_settings[jrojas_redes_googleplus]" type="url" value="<?php //echo $googlePlusSB; ?>">
    </div>
    
    <div class="jrojas-settings-page-inputs">
        <label for="linkedin-redes-jrojas"><?php //_e('Linkedin', 'jrojas'); ?></label>
        <input id="linkedin-redes-jrojas" name="jrojas_settings[jrojas_redes_linkedin]" type="url" value="<?php //echo $linkedinSB; ?>">
    </div>
    
    <div class="jrojas-settings-page-inputs">
        <label for="github-redes-jrojas"><?php //_e('GitHub', 'jrojas'); ?></label>
        <input id="github-redes-jrojas" name="jrojas_settings[jrojas_redes_github]" type="url" value="<?php //echo $githubSB ; ?>">
    </div>
    
    <div class="jrojas-settings-page-inputs">
        <label for="pinterest-redes-jrojas"><?php //_e('Pinterest', 'jrojas'); ?></label>
        <input id="pinterest-redes-jrojas" name="jrojas_settings[jrojas_redes_pinterest]" type="url" value="<?php //echo $pinterestSB; ?>">
    </div>
    
    <div class="jrojas-settings-page-inputs">
        <label for="behance-redes-jrojas"><?php //_e('Behance', 'jrojas'); ?></label>
        <input id="behance-redes-jrojas" name="jrojas_settings[jrojas_redes_behance]" type="url" value="<?php //echo $behanceSB; ?>">
    </div>
    
    <div class="jrojas-settings-page-inputs">
        <label for="snapchat-redes-jrojas"><?php //_e('Snapchat', 'jrojas'); ?></label>
        <input id="snapchat-redes-jrojas" name="jrojas_settings[jrojas_redes_snapchat]" type="url" value="<?php //echo $snapchatSB; ?>">
    </div>-->
        
<?php
}

//funciones que imprimen html de la opcion de seguir en el footer
function jrojas_settings_admin_html_redes_footer() {
    $jrojasSettings = get_option('jrojas_settings');
    $seguinos = isset($jrojasSettings['jrojas_footer_seguinos']) ? $jrojasSettings['jrojas_footer_seguinos'] : '0';
    
    ?>

    <!-- seccion header -->
    <div class="jrojas-settings-page-inputs">
        <label for="jrojas_settings[jrojas_footer_seguinos]"><?php _e('Mostrar en Footer', 'jrojas'); ?></label>
        <input class="input-checkbox" type="checkbox" name="jrojas_settings[jrojas_footer_seguinos]" value="<?php echo esc_attr( $seguinos); ?>" <?php if ($seguinos == '1') {echo 'checked'; } ?>/>	
    </div>
    
<?php
}

function jrojas_settings_admin_html_instagram_footer() {
    $jrojasSettings = get_option('jrojas_settings');
    $activar = isset($jrojasSettings['jrojas_footer_instagram']) ? $jrojasSettings['jrojas_footer_instagram'] : '0';
    $scriptInstagram = isset( $jrojasSettings['jrojas_footer_instagram_script'] ) ? $jrojasSettings['jrojas_footer_instagram_script'] : '';
    
    ?>

    <!-- seccion header -->
    <div class="jrojas-settings-page-inputs">
        <label for="jrojas_settings[jrojas_footer_instagram]"><?php _e('Mostrar en Footer', 'jrojas'); ?></label>
        <input class="input-checkbox" type="checkbox" name="jrojas_settings[jrojas_footer_instagram]" value="<?php echo esc_attr( $activar); ?>" <?php if ($activar == '1') {echo 'checked'; } ?>/>	
    </div>

    <div class="jrojas-settings-page-inputs">
        <label for="jrojas_settings[jrojas_footer_instagram_script]"><?php _e('Copiar Link aquí', 'jrojas'); ?></label>
        <textarea name="jrojas_settings[jrojas_footer_instagram_script]"><?php echo  $scriptInstagram; ?></textarea>
    </div>

    <p style="text-align:left">
        Para crear el link hay que visitar la página con el link debajo, loguearse, completar las variables, estilo cuantas imágenes, animación, etc. Luego hacer clic en Get Code y  te dara un script para copiar dentro de este espacio.</p>
    <p style="text-align:left">Para ir a la página hacer click <a href="https://lightwidget.com/" target="_blank">Aquí</a></p>
    
    <?php
}