<?php

/**
 * Plugin Name: Press Elements
 * Description: An easy-to-use Elementor widgets that helps you design single page templates to display your content.
 * Plugin URI:  https://wordpress.org/plugins/press-elements/
 * Version:     1.0.0
 * Author:      Rami Yushuvaev
 * Author URI:  https://wpPlugins.io/
 * Text Domain: press-elements
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    die;
}
/**
 * Load Press Elements
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function press_elements_load()
{
    // Load localization file
    load_plugin_textdomain( 'press-elements' );
    // Notice if the Elementor is not active
    
    if ( !did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'press_elements_fail_load' );
        return;
    }
    
    // Check version required
    $elementor_version_required = '1.3.4';
    
    if ( !version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
        add_action( 'admin_notices', 'press_elements_fail_load_out_of_date' );
        return;
    }
    
    // Require plugin files
    require __DIR__ . '/admin.php';
    require __DIR__ . '/plugin.php';
}

add_action( 'plugins_loaded', 'press_elements_load' );
/**
 * Load Freemius SDK
 *
 * Load and init Freemius SDK for this plugin.
 *
 * @since 1.0.0
 */
function press_elements_freemius()
{
    global  $press_elements_freemius ;
    
    if ( !isset( $press_elements_freemius ) ) {
        // Include Freemius SDK.
        require_once dirname( __FILE__ ) . '/freemius/start.php';
        $press_elements_freemius = fs_dynamic_init( array(
            'id'             => '761',
            'slug'           => 'press-elements',
            'type'           => 'plugin',
            'public_key'     => 'pk_fe2850d57f7d4f206aefaa106b91f',
            'is_premium'     => false,
            'has_addons'     => false,
            'has_paid_plans' => true,
            'menu'           => array(
            'slug'       => 'press-elements',
            'first-path' => 'themes.php?page=press-elements&tab=getting-started',
            'contact'    => false,
            'support'    => false,
            'parent'     => array(
            'slug' => 'themes.php',
        ),
        ),
            'is_live'        => true,
        ) );
    }
    
    return $press_elements_freemius;
}

// Init Freemius.
press_elements_freemius();
function press_elements_freemius_settings_url()
{
    return admin_url( 'themes.php?page=press-elements&tab=about' );
}

press_elements_freemius()->add_filter( 'connect_url', 'press_elements_freemius_settings_url' );
press_elements_freemius()->add_filter( 'after_skip_url', 'press_elements_freemius_settings_url' );
press_elements_freemius()->add_filter( 'after_connect_url', 'press_elements_freemius_settings_url' );