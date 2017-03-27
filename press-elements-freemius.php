<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    die;
}
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
            'slug'    => 'press-elements',
            'contact' => false,
            'support' => false,
            'parent'  => array(
            'slug' => 'themes.php',
        ),
        ),
            'is_live'        => true,
        ) );
    }
    
    return $press_elements_freemius;
}

/**
 * Settings URL
 *
 * @since 1.0.0
 *
 * @return string
 */
function press_elements_freemius_settings_url()
{
    return admin_url( 'themes.php?page=press-elements&tab=about' );
}

// Init Freemius
press_elements_freemius();
// Set settings URL
press_elements_freemius()->add_filter( 'connect_url', 'press_elements_freemius_settings_url' );
press_elements_freemius()->add_filter( 'after_skip_url', 'press_elements_freemius_settings_url' );
press_elements_freemius()->add_filter( 'after_connect_url', 'press_elements_freemius_settings_url' );