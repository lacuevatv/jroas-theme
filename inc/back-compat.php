<?php
/**
 * Back compat functionality
 *
 * Prevents the theme from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage jrojas
 * @since 1.0
 */

/**
 * Prevent switching to jrojas on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since 1.0
 */
function jrojas_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'jrojas_upgrade_notice' );
}
add_action( 'after_switch_theme', 'jrojas_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * jrojas on WordPress versions prior to 4.7.
 *
 * @since 1.0
 *
 * @global string $wp_version WordPress version.
 */
function jrojas_upgrade_notice() {
	$message = sprintf( __( 'Se necesita una version mayor a 4.7. Su actual version es %s. Actualize e intente nuevamente.', 'jrojas' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since 1.0
 *
 * @global string $wp_version WordPress version.
 */
function jrojas_customize() {
	wp_die( sprintf( __( 'Se necesita una version mayor a 4.7. Su actual version es %s. Actualize e intente nuevamente.', 'jrojas' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'jrojas_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since 1.0
 *
 * @global string $wp_version WordPress version.
 */
function jrojas_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Se necesita una version mayor a 4.7. Su actual version es %s. Actualize e intente nuevamente.', 'jrojas' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'jrojas_preview' );