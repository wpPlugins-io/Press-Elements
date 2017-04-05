<?php
/**
 * Plugin Name: Press Elements - Widgets for Elementor
 * Description: An easy-to-use widgets that help you display and design your content using Elementor page builder.
 * Plugin URI:  https://wordpress.org/plugins/press-elements/
 * Version:     1.3.1
 * Author:      Rami Yushuvaev
 * Author URI:  https://wpPlugins.io/
 * Text Domain: press-elements
 */



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



// Make sure the same methods/classes aren’t loaded twice for free/premium versions
if ( ! function_exists( 'press_elements_load' ) ) {



	// Load Freemius SDK
	require( __DIR__ . '/press-elements-freemius.php' );



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

		// Require admin files - displays even if Elementor is not active
		require( __DIR__ . '/press-elements-admin.php' );

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

		// Require plugin files - displays only if Elementor is active
		require( __DIR__ . '/press-elements-plugin.php' );

	}
	add_action( 'plugins_loaded', 'press_elements_load' );



	/**
	 * Admin notice
	 *
	 * Warning when Elementor is not installed and activated.
	 *
	 * @since 1.1.0
	 */
	function press_elements_admin_notice_missing_main_plugin() {
		$class = 'notice notice-warning is-dismissible';
		$message = sprintf(
			/* translators: 1: Press Elements 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'press-elements' ),
			'<strong>' . esc_html__( 'Press Elements', 'press-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'press-elements' ) . '</strong>'
		);

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
	}



	/**
	 * Admin notice
	 *
	 * Warning when Elementor doen't have a minimum required version.
	 *
	 * @since 1.1.0
	 */
	function press_elements_admin_notice_main_plugin_required_version() {
		$elementor_version_required = '1.3.4';
		$class = 'notice notice-warning is-dismissible';
		$message = sprintf(
			/* translators: 1: Press Elements 2: Elementor 3: Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'press-elements' ),
			'<strong>' . esc_html__( 'Press Elements', 'press-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'press-elements' ) . '</strong>',
			$elementor_version_required
		);

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
	}



}
