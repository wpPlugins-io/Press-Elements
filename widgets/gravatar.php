<?php
namespace PressElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Press Elements Gravatar
 *
 * Gravatar element for elementor.
 *
 * @since 1.4.0
 */
class Press_Elements_Gravatar extends Widget_Base {

	public function get_name() {
		return 'gravatar';
	}

	public function get_title() {
		return __( 'Gravatar', 'press-elements' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'press-elements-integrations' ];
	}

	protected function _register_controls() {

		if ( ! press_elements_freemius()->is__premium_only() ) {

			$this->start_controls_section(
				'section_pro_feature',
				[
					'label' => __( 'Gravatar', 'press-elements' ),
				]
			);

			$this->add_control(
				'pro_feature',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' =>
						'<div class="elementor-panel-nerd-box">
							<i class="elementor-panel-nerd-box-icon fa fa-lock"></i>
							<div class="elementor-panel-nerd-box-title">' .
								__( 'Premium Feature', 'press-elements' ) .
							'</div>
							<div class="elementor-panel-nerd-box-message">' .
								sprintf(
									/* translators: %s: Press Elements Pro */
									__( 'This feature is only available on "%s".', 'press-elements' ),
									'<strong>' . __( 'Press Elements Pro', 'press-elements' ) . '</strong>'
								) .
							'</div>
							<a class="elementor-panel-nerd-box-link elementor-button elementor-button-default elementor-go-pro" href="' . press_elements_freemius()->get_upgrade_url() . '" target="_blank">' .
								__( 'Upgrade Now!', 'press-elements' ) .
							'</a>
						</div>',
					'separator' => 'none',
				]
			);

			$this->end_controls_section();

		}

		if ( press_elements_freemius()->is__premium_only() ) {

			$this->start_controls_section(
				'section_content',
				[
					'label' => __( 'Gravatar', 'press-elements' ),
				]
			);

			$this->add_control(
				'gravatar_email',
				[
					'label' => __( 'Email', 'press-elements' ),
					'type'  => Controls_Manager::TEXT,
					'placeholder' => __( 'your@email.com', 'press-elements' ),
				]
			);

			$this->add_control(
				'html_tag',
				[
					'label' => __( 'HTML Tag', 'press-elements' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h1' => __( 'H1', 'press-elements' ),
						'h2' => __( 'H2', 'press-elements' ),
						'h3' => __( 'H3', 'press-elements' ),
						'h4' => __( 'H4', 'press-elements' ),
						'h5' => __( 'H5', 'press-elements' ),
						'h6' => __( 'H6', 'press-elements' ),
						'p'  => __( 'p', 'press-elements' ),
						'div' => __( 'div', 'press-elements' ),
						'span' => __( 'span', 'press-elements' ),
					],
					'default' => 'div',
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' => __( 'Alignment', 'press-elements' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'press-elements' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'press-elements' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'press-elements' ),
							'icon' => 'fa fa-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'press-elements' ),
							'icon' => 'fa fa-align-justify',
						],
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'link_to',
				[
					'label' => __( 'Link to', 'press-elements' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' => __( 'None', 'press-elements' ),
						'home' => __( 'Home URL', 'press-elements' ),
						'post' => __( 'Post URL', 'press-elements' ),
						'custom' => __( 'Custom URL', 'press-elements' ),
					],
				]
			);

			$this->add_control(
				'link',
				[
					'label' => __( 'Link', 'press-elements' ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'http://your-link.com', 'press-elements' ),
					'condition' => [
						'link_to' => 'custom',
					],
					'default' => [
						'url' => '',
					],
					'show_label' => false,
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_style',
				[
					'label' => __( 'Gravatar', 'press-elements' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'space',
				[
					'label' => __( 'Size (%)', 'press-elements' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 100,
						'unit' => '%',
					],
					'size_units' => [ '%' ],
					'range' => [
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-gravatar img' => 'max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'opacity',
				[
					'label' => __( 'Opacity (%)', 'press-elements' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 1,
					],
					'range' => [
						'px' => [
							'max' => 1,
							'min' => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-gravatar img' => 'opacity: {{SIZE}};',
					],
				]
			);

			$this->add_control(
				'angle',
				[
					'label' => __( 'Angle (deg)', 'press-elements' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'deg' ],
					'default' => [
						'unit' => 'deg',
						'size' => 0,
					],
					'range' => [
						'deg' => [
							'max' => 360,
							'min' => -360,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-gravatar img' => '-webkit-transform: rotate({{SIZE}}deg); -moz-transform: rotate({{SIZE}}deg); -ms-transform: rotate({{SIZE}}deg); -o-transform: rotate({{SIZE}}deg); transform: rotate({{SIZE}}deg);',
					],
				]
			);

			$this->add_control(
				'hover_animation',
				[
					'label' => __( 'Hover Animation', 'press-elements' ),
					'type' => Controls_Manager::HOVER_ANIMATION,
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'image_border',
					'label' => __( 'Image Border', 'press-elements' ),
					'selector' => '{{WRAPPER}} .press-elements-gravatar img',
				]
			);

			$this->add_control(
				'image_border_radius',
				[
					'label' => __( 'Border Radius', 'press-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .press-elements-gravatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'image_box_shadow',
					'selector' => '{{WRAPPER}} .press-elements-gravatar img',
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		if ( press_elements_freemius()->is__premium_only() ) {

			$settings = $this->get_settings();

			$gravatar = get_avatar( $settings['gravatar_email'], 512 );
			if ( empty( $gravatar ) )
				return;

			switch ( $settings['link_to'] ) {
				case 'custom' :
					if ( ! empty( $settings['link']['url'] ) ) {
						$link = esc_url( $settings['link']['url'] );
					} else {
						$link = false;
					}
					break;

				case 'post' :
					$link = esc_url( get_the_permalink() );
					break;

				case 'home' :
					$link = esc_url( get_home_url() );
					break;

				case 'none' :
				default:
					$link = false;
					break;
			}
			$target = $settings['link']['is_external'] ? 'target="_blank"' : '';

			$animation_class = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . $settings['hover_animation'] : '';

			$html = '<div class="press-elements-gravatar ' . $animation_class . '">';
			if ( $link ) {
				$html .= sprintf( '<a href="%1$s" %2$s>%3$s</a>', $link, $target, $gravatar );
			} else {
				$html .= $gravatar;
			}
			$html .= '</div>';

			echo $html;

		}

	}

	protected function _content_template() {
	}

}
