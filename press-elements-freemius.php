<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load Freemius SDK
 *
 * Load and init Freemius SDK for this plugin.
 *
 * @since 1.0.0
 */
function press_elements_freemius() {
	global  $press_elements_freemius ;

	if ( !isset( $press_elements_freemius ) ) {
		// Include Freemius SDK.
		require_once dirname( __FILE__ ) . '/libs/freemius/start.php';
		$press_elements_freemius = fs_dynamic_init( array(
			'id'             => '761',
			'slug'           => 'press-elements',
			'type'           => 'plugin',
			'public_key'     => 'pk_fe2850d57f7d4f206aefaa106b91f',
			'is_premium'     => true,
			'has_addons'     => false,
			'has_paid_plans' => true,
			'menu'           => array(
				'slug'        => 'press-elements',
				'contact'     => false,
				'support'     => false,
				'pricing'     => false,
				'parent'      => array(
					'slug'     => 'options-general.php',
				),
			),
		) );
	}

	return $press_elements_freemius;
}

/**
 * Add header title
 *
 * Insets H1 title to the freemius templates.
 *
 * @since 1.6.0
 */
function press_elements_freemius_header( $html ) {

	return sprintf(
		'<h1>%1$s</h1>%2$s',
		esc_html_e( 'Press Elements - Widgets for Elementor', 'press-elements' ),
		$html
	);

}

// Init Freemius
press_elements_freemius();
press_elements_freemius()->add_filter( 'templates/account.php', 'press_elements_freemius_header' );
press_elements_freemius()->add_filter( 'templates/billing.php', 'press_elements_freemius_header' );

// Signal that SDK was initiated.
do_action( 'press_elements_freemius_loaded' );
