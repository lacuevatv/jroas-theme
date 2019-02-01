<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper" <?php if( is_page_template( 'page-agenda.php' ) ) { echo 'id="agenda"'; } ?>>
	
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Directo al contenido', 'jrojas' ); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation" class="navbar navbar-dark main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Menú', 'jrojas' ); ?>">
        
            <div class="container align-items-center">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar-second-level"
                    aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburguer-icon"></div>
                    <div class="hamburguer-icon"></div>
                    <div class="hamburguer-icon"></div>
                </button>
                <h2 class="navbar-title">JORGE ROJAS</h2>
                <div class="social-media">
                    <ul>
                        <li>
                            <a href="https://twitter.com/jrojasoficial?lang=es" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/twitter@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/twitter@3x.png 3x"
                                    alt="Twitter"></a>
                        </li>
                        <li>
                            <a href="https://es-la.facebook.com/JRojasOficial/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-logo-in-circular-button-outlined-social-symbol.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-logo-in-circular-button-outlined-social-symbol@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/facebook-logo-in-circular-button-outlined-social-symbol@3x.png 3x"
                                    alt="Facebook"></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/jorgerojasoficial/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/instagram@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/instagram@3x.png 3x"
                                    alt="Instagram"></a>
                        </li>
                        <li>
                            <a href="https://open.spotify.com/artist/45SolwUehJs6vFkuAfqMf6" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/spotify.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/spotify@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/spotify@3x.png 3x"
                                    alt="Spotify"></a>
                        </li>
                        <li>
                            <a href="https://itunes.apple.com/ar/artist/jorge-rojas/95291524" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/page-1.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/page-1@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/page-1@3x.png 3x"
                                    alt="AppleMusic"></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/user/manonegra2012" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/youtube-play-button-outlined-social-symbol.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/youtube-play-button-outlined-social-symbol@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/youtube-play-button-outlined-social-symbol@3x.png 3x"
                                    alt="Youtube"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="navbar-collapse collapse" id="navbar-second-level">
                <ul class="navbar-nav text-center">
                    
                <?php

                    $walk_main_nav = new My_Walker_Menu();
                    $main_nav = wp_nav_menu( array( 'theme_location' => 'menu-1', 'container' => '', 'fallback_cb' => '', 'echo' => false, 'items_wrap' => '%3$s', 'walker' => $walk_main_nav ) );

                    echo $main_nav;
                ?>

                </ul>
                <div class="social-media social-media-mobile">
                    <ul>
                        <li>
                            <a href="https://twitter.com/jrojasoficial?lang=es" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/twitter@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/twitter@3x.png 3x"
                                    alt="Twitter"></a>
                        </li>
                        <li>
                            <a href="https://es-la.facebook.com/JRojasOficial/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-logo-in-circular-button-outlined-social-symbol.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-logo-in-circular-button-outlined-social-symbol@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/facebook-logo-in-circular-button-outlined-social-symbol@3x.png 3x"
                                    alt="Facebook"></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/jorgerojasoficial/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/instagram@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/instagram@3x.png 3x"
                                    alt="Instagram"></a>
                        </li>
                        <li>
                            <a href="https://open.spotify.com/artist/45SolwUehJs6vFkuAfqMf6" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/spotify.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/spotify@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/spotify@3x.png 3x"
                                    alt="Spotify"></a>
                        </li>
                        <li>
                            <a href="https://itunes.apple.com/ar/artist/jorge-rojas/95291524" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/page-1.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/page-1@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/page-1@3x.png 3x"
                                    alt="AppleMusic"></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/user/manonegra2012" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/youtube-play-button-outlined-social-symbol.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/youtube-play-button-outlined-social-symbol@2x.png 2x,
                            <?php echo get_template_directory_uri(); ?>/assets/images/youtube-play-button-outlined-social-symbol@3x.png 3x"
                                    alt="Youtube"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header><!-- #masthead -->

    <div class="site-content-contain">
		<div id="content" class="site-content">