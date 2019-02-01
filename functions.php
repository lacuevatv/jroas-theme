<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 */

/**
 * Only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

//CONSTANTES //
define('IMAGES_DIR' , get_template_directory_uri() . '/assets/images/');
define('TEMPLATES' , get_template_directory_uri() . '/template-parts/');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

if ( ! function_exists( ' jrojas_setup' ) ) {
    function jrojas_setup() {
        /*
        * Make theme available for translation.
        * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
        * If you're building a theme based on Twenty Seventeen, use a find and replace
        * to change 'twentyseventeen' to the name of your theme in all the template files.
        */

        load_theme_textdomain( 'jrojas', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support( 'title-tag' );
        
        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'medium', 768, 768 );
		//set_post_thumbnail_size( 550, 768, true );
		

		class My_Walker_Menu extends Walker_Nav_Menu
		{
		    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
				
		    	/*$object = $item->object;
		    	$type = $item->type;*/
		    	$title = $item->title;
		    	$description = $item->description;
		    	$permalink = $item->url;
		        $output .= "<li class='" .  implode(" ", $item->classes) . " nav-item'>";
		        $output .= '<a href="' . $permalink . '"><span class="menu-item">';
		      	$output .= $title;
		      	$output .= '</span></a>';

		    }
		}

        // This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Principal', 'jrojas' ),
        ) );
        
        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
        ) );
        
        // Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'thonet_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
        
        /**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		/*add_theme_support( 'custom-logo', array(
			'height'      => 500,
			'width'       => 500,
			'flex-width'  => true,
			'flex-height' => true,
		) );*/


		//habilita los excerpt en las paginas
		add_post_type_support( 'page', 'excerpt' );

		//QUITA LOS ESTILOS DE LA GALERÍA POR DEFECTO
		add_filter( 'use_default_gallery_style', '__return_false' );

    }
}

add_action( 'after_setup_theme', 'jrojas_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jrojas_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Barra lateral', 'jrojas' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Agregar widgets aquí.', 'jrojas' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
    ) );
    
}

add_action( 'widgets_init', 'jrojas_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function jrojas_scripts() {
	//owlcarousel
	//wp_enqueue_style( 'owlcarousel', get_template_directory_uri() . '/assets/css/owl-styles/owl.carousel.min.css', array(), '2.2.1', 'all' );
	//estilo principal del sitio
	wp_enqueue_style( 'wp-main-style', get_stylesheet_uri() );
	
	//estilos
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css' );
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/main.css' );
	wp_enqueue_style( 'media-queries', get_template_directory_uri() . '/assets/css/media-queries.css' );
	wp_enqueue_style( 'navbar', get_template_directory_uri() . '/assets/css/navbar.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/libs/bootstrap-4.0.0-dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/libs/slick/slick.css' );

	//agregar js de bootstrap
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/libs/bootstrap-4.0.0-dist/js/bootstrap.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'instanfeed', get_template_directory_uri() . '/assets/libs/instafeed.min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/libs/slick/slick.min.js', array('jquery'), '1.0', true );

	//agregar js específico del theme
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/main-script.js', array('jquery'), '1.0', true );

	wp_localize_script( 'main-script', 'jrojasScriptsData', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	) );

}

add_action( 'wp_enqueue_scripts', 'jrojas_scripts' );

/**
 * Enqueue scripts and styles for admin.
 */

if ( ! function_exists( 'jrojas_wp_admin_style_scripts' ) ) {
	/**
	 * enqueue admin style
	 *
	 * @since 1.0
	 *
	 * @uses wp_enqueue_style()
	 */
	function jrojas_wp_admin_style_scripts() {
        wp_enqueue_style( 'jrojas-style-admin', get_template_directory_uri() . '/assets/css/admin-style.css', array(), '1.0', 'all' );
		
		//agregar el paquete de media para usar la api
		wp_enqueue_media();
		wp_enqueue_script( 'jquery ui', get_template_directory_uri() . '/assets/js/jquery-ui.min.js', array('jquery'), '1.0', true );
        wp_enqueue_script( 'jrojas-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), '1.0', true );
		
	}
}

add_action( 'admin_enqueue_scripts', 'jrojas_wp_admin_style_scripts' );


/*if ( ! function_exists( 'ukpartners_upload_mimes' ) ) {
	/**
	 * HABILITA EL UPLOAD DE SVG
	*/
	/*function jrojas_upload_mimes($mimes = array()) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}
add_filter('upload_mimes', 'jrojas_upload_mimes');*/



/*if ( ! function_exists( 'remove_editor_en_template_home' ) ) {
	/**
	 * quita el editor de wordpress en el template de la pagina de inicio para que no haya errores
	 *
	 * @since 1.0
	 *
	 * @uses get_post_meta()
	 */
	/*add_action('init', 'remove_editor_en_template_home');

	function remove_editor_en_template_home() {
		if (isset($_GET['post'])) {
			$id = $_GET['post'];
			$pageTemplate = get_post_meta( $id, '_wp_page_template', true );

			if( $pageTemplate == 'page-home.php' || $pageTemplate == 'admin/page-home.php' ) {
				remove_post_type_support('page', 'editor');
			}
		}
	}
}*/



//Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

//Customizer additions.
//require get_template_directory() . '/inc/customizer.php';

//Custon Posty Types
require get_template_directory() . '/inc/post-type.php';
//meta boxes
require get_template_directory() . '/admin/meta-boxes.php';

//Load settings files.
//require get_template_directory() . '/admin/settings.php';

require_once get_template_directory() . '/admin/ajax.php';

//require_once  get_template_directory() . '/inc/lib/mobile-detect/Mobile_Detect.php';

/*
 * FUNCIONES DEL TEMA
 * por ejemplo, mostrar metaboxes específicos
 */

if ( ! function_exists( 'jr_getDataVideo' ) ) {
	/**
	 * muestra los meta info resumenes de destinos, cursos y alojamientos
	 *
	 * @since 1.0
	 *
	 * @uses get_post_meta()
	 */
	function jr_getDataVideo($link) {
		if ( $link != '' && strpos($link, '=') === false ) {
			$codigo = explode('/',$link)[3];
		} else {
			$codigo = explode('=',$link)[1];
		}

		return $codigo;
	}
}

if ( ! function_exists( 'sendEmailPhpMailer' ) ) {
	/**
	 * envia los formularios con phpmailer
	 *
	 * @since 1.0
	 *
	 * @uses get_post_meta()
	 */
	function sendEmailPhpMailer( $emailReplyTo, $nombreReplyTo, $emailTo, $nombreTo, $asunto, $contenido) {
		require_once("inc/lib/class.phpmailer.php");
		require_once("inc/lib/class.smtp.php");

		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		//$mail->Username = '';
		//$mail->Password = '';
		$mail->SMTPAuth = true;

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		$mail->CharSet = 'UTF-8';
		//Set who the message is to be sent from
		//$mail->setFrom(EMAILDEFAULT, SITETITLE);
		$mail->setFrom('coco.kmkz@gmail.com', 'Jorge Rojas');
		//Set an alternative reply-to address
		$mail->addReplyTo($emailReplyTo, $nombreReplyTo);
		//Set who the message is to be sent to
		$mail->addAddress($emailTo, $nombreTo);
		//Set the subject line
		$mail->Subject = $asunto;
		$mail->IsHTML(true);
		//Read an HTML message body from an external file, convert referenced images to embedded,
		$mail->MsgHTML($contenido);
		$mail->AltBody = $contenido;
		//send the message, check for errors
		
		if (!$mail->send()) {
			$error = ' - '. $mail->ErrorInfo;
			return $error;
			
		} else {
			return 'Su mensaje ha sido enviado';
		}
	}
}

/*if ( ! function_exists( 'dispositivo' ) ) {
	/**
	 * detecta dispositivo
	 *
	 * @since 1.0
	 */
	/*function dispositivo() {

		$dispositivo = 'pc';
		$detect = new Mobile_Detect;
		if ( $detect->isMobile() ) {
			$dispositivo = 'movil';
		}
			
		// Any tablet device.
		if( $detect->isTablet() ){
			$dispositivo = 'tablet';
		}

		return $dispositivo;

	}
}*/

