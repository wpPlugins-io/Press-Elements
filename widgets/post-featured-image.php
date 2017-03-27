<?php

namespace PressElements\Widgets;

use  Elementor\Widget_Base ;
use  Elementor\Controls_Manager ;
use  Elementor\Group_Control_Image_Size ;
use  Elementor\Group_Control_Border ;
use  Elementor\Group_Control_Box_Shadow ;
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    die;
}
/**
 * Press Elements Post Featured Image
 *
 * Single post/page featured image element for elementor.
 *
 * @since 1.0.0
 */
class Press_Elements_Post_Featured_Image extends Widget_Base
{
    public function get_name()
    {
        return 'post-featured-image';
    }
    
    public function get_title()
    {
        $queried_object = get_queried_object();
        $post_type_object = get_post_type_object( get_post_type( $queried_object ) );
        return sprintf( __( '%s Featured Image', 'press-elements' ), $post_type_object->labels->singular_name );
    }
    
    public function get_icon()
    {
        return 'fa fa-picture-o';
    }
    
    public function get_categories()
    {
        return array( 'press-elements-post-elements' );
    }
    
    protected function _register_controls()
    {
        $queried_object = get_queried_object();
        $post_type_object = get_post_type_object( get_post_type( $queried_object ) );
        $this->start_controls_section( 'section_content', array(
            'label' => sprintf( __( '%s Featured Image', 'press-elements' ), $post_type_object->labels->singular_name ),
        ) );
        $this->add_control( 'pro_content', array(
            'type'      => Controls_Manager::RAW_HTML,
            'raw'       => '<div class="elementor-panel-nerd-box">
						<i class="elementor-panel-nerd-box-icon fa fa-lock"></i>
						<div class="elementor-panel-nerd-box-title">' . __( 'Premium Feature', 'press-elements' ) . '</div>
						<div class="elementor-panel-nerd-box-message">' . __( 'This feature is available only for Press Elements Pro.', 'press-elements' ) . '</div>
						<a class="elementor-panel-nerd-box-link elementor-button elementor-button-default elementor-go-pro" href="' . press_elements_freemius()->get_upgrade_url() . '" target="_blank">' . __( 'Upgrade Now!', 'press-elements' ) . '</a>
						</div>',
            'separator' => 'none',
        ) );
        $this->end_controls_section();
        $this->start_controls_section( 'section_style', array(
            'label' => sprintf( __( '%s Featured Image', 'press-elements' ), $post_type_object->labels->singular_name ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ) );
        $this->add_control( 'pro_style', array(
            'type'      => Controls_Manager::RAW_HTML,
            'raw'       => '<div class="elementor-panel-nerd-box">
						<i class="elementor-panel-nerd-box-icon fa fa-lock"></i>
						<div class="elementor-panel-nerd-box-title">' . __( 'Premium Feature', 'press-elements' ) . '</div>
						<div class="elementor-panel-nerd-box-message">' . __( 'This feature is available only for Press Elements Pro.', 'press-elements' ) . '</div>
						<a class="elementor-panel-nerd-box-link elementor-button elementor-button-default elementor-go-pro" href="' . press_elements_freemius()->get_upgrade_url() . '" target="_blank">' . __( 'Upgrade Now!', 'press-elements' ) . '</a>
						</div>',
            'separator' => 'none',
        ) );
        $this->end_controls_section();
    }
    
    protected function render()
    {
    }
    
    protected function _content_template()
    {
    }

}