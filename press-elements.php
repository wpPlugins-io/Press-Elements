<?php
/**
 * Plugin Name: Press Elements
 * Description: An easy-to-use Elementor widgets that helps you design single page templates to display your content.
 * Plugin URI:  https://wordpress.org/plugins/press-elements/
 * Version:     1.1.0
 * Author:      Rami Yushuvaev
 * Author URI:  https://wpPlugins.io/
 * Text Domain: press-elements
 */



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Load Press Elements
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function press_elements_load() {

	// Load localization file
	load_plugin_textdomain( 'press-elements' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'press_elements_admin_notice_missing_main_plugin' );
		return;
	}

	// Check version required
	$elementor_version_required = '1.3.4';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'press_elements_admin_notice_main_plugin_required_version' );
		return;
	}

	// Require plugin files
	require( __DIR__ . '/press-elements-freemius.php' );
	require( __DIR__ . '/press-elements-admin.php' );
	require( __DIR__ . '/press-elements-plugin.php' );

}
add_action( 'plugins_loaded', 'press_elements_load' );



/**
 * Admin notices
 *
 * Warning when Elementor is not installed and activated
 *
 * @since 1.1.0
 */
function press_elements_admin_notice_missing_main_plugin() {
	$class = 'notice notice-warning is-dismissible';
	$message = sprintf(
		esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'press-elements' ),
		'<strong>' . esc_html__( 'Press Elements', 'press-elements' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'press-elements' ) . '</strong>'
	);

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
}



/**
 * Admin notices
 *
 * Warning when Elementor doen't have a minimum required version.
 *
 * @since 1.1.0
 */
function press_elements_admin_notice_main_plugin_required_version() {
	$elementor_version_required = '1.3.4';
	$class = 'notice notice-warning is-dismissible';
	$message = sprintf(
		esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'press-elements' ),
		'<strong>' . esc_html__( 'Press Elements', 'press-elements' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'press-elements' ) . '</strong>',
		$elementor_version_required
	);

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message ); 
}
