<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 * @version 1.0
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container main-footer">
                <div class="social-media">
                    <ul>
                        <li>
                            <a href="https://twitter.com/jrojasoficial?lang=es"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.png" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/twitter@2x.png 2x,
                                    <?php echo get_template_directory_uri(); ?>/assets/images/twitter@3x.png 3x"
                                    alt="Twitter"></a>
                        </li>
                        <li>
                            <a href="https://es-la.facebook.com/JRojasOficial/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-logo-in-circular-button-outlined-social-symbol.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-logo-in-circular-button-outlined-social-symbol@2x.png 2x,
                                    <?php echo get_template_directory_uri(); ?>/assets/images/facebook-logo-in-circular-button-outlined-social-symbol@3x.png 3x"
                                    alt="Facebook"></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/jorgerojasoficial/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/instagram@2x.png 2x,
                                    <?php echo get_template_directory_uri(); ?>/assets/images/instagram@3x.png 3x"
                                    alt="Instagram"></a>
                        </li>
                        <li>
                            <a href="https://open.spotify.com/artist/45SolwUehJs6vFkuAfqMf6"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/spotify.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/spotify@2x.png 2x,
                                    <?php echo get_template_directory_uri(); ?>/assets/images/spotify@3x.png 3x"
                                    alt="Spotify"></a>
                        </li>
                        <li>
                            <a href="https://itunes.apple.com/ar/artist/jorge-rojas/95291524"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/page-1.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/page-1@2x.png 2x,
                                    <?php echo get_template_directory_uri(); ?>/assets/images/page-1@3x.png 3x"
                                    alt="AppleMusic"></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/user/manonegra2012"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/youtube-play-button-outlined-social-symbol.png"
                                    srcset="<?php echo get_template_directory_uri(); ?>/assets/images/youtube-play-button-outlined-social-symbol@2x.png 2x,
                                    <?php echo get_template_directory_uri(); ?>/assets/images/youtube-play-button-outlined-social-symbol@3x.png 3x"
                                    alt="Youtube"></a>
                        </li>
                    </ul>
                </div>
                <div class="legal d-flex justify-content-center">
                    <p class="legal-txt">2019 - Todos los derechos reservados</p>
                </div>
                <div class="sancor d-flex justify-content-center align-items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sancor-seguros.png" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/sancor-seguros@2x.png 2x,
                    <?php echo get_template_directory_uri(); ?>/assets/images/sancor-seguros@3x.png 3x" alt="Logo Grupo Sancor Seguro">
                </div>

                <div class="data-fiscal d-flex justify-content-center align-items-end">
                    <img class="sancor-pc-imagen" src="<?php echo get_template_directory_uri(); ?>/assets/images/sancor-seguros.png" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/sancor-seguros@2x.png 2x,
                        <?php echo get_template_directory_uri(); ?>/assets/images/sancor-seguros@3x.png 3x" alt="Logo Grupo Sancor Seguro">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/data-fiscal.png" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/data-fiscal@2x.png 2x,
                    <?php echo get_template_directory_uri(); ?>/assets/images/data-fiscal@3x.png 3x" alt="Logo Grupo Sancor Seguro">
                </div>
            </div>
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page .wrapper-->
<?php wp_footer(); ?>

</body>
</html>