<?php
namespace PressElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Press Elements Post Custom Field
 *
 * Single post/page custom field element for elementor.
 *
 * @since 1.0.0
 */
class Press_Elements_Post_Custom_Field extends Widget_Base {

	public function get_name() {
		return 'post-custom-field';
	}

	public function get_title() {
		$post_type_object = get_post_type_object( get_post_type() );

		return sprintf(
			/* translators: %s: Post type singular name (e.g. Post or Page) */
			__( '%s Custom Field', 'press-elements' ),
			$post_type_object->labels->singular_name
		);
	}

	public function get_icon() {
		return 'fa fa-plus-circle';
	}

	public function get_categories() {
		return [ 'press-elements-post-elements' ];
	}

	protected function _register_controls() {

		$post_type_object = get_post_type_object( get_post_type() );

		if ( ! press_elements_freemius()->is__premium_only() ) {

			$this->start_controls_section(
				'section_pro_feature',
				[
					'label' => sprintf(
						/* translators: %s: Post type singular name (e.g. Post or Page) */
						__( '%s Custom Field', 'press-elements' ),
						$post_type_object->labels->singular_name
					),
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
					'label' => sprintf(
						/* translators: %s: Post type singular name (e.g. Post or Page) */
						__( '%s Custom Field', 'press-elements' ),
						$post_type_object->labels->singular_name
					),
				]
			);

			$custom_field = get_post_custom();
			$fields = array();
			foreach ( $custom_field as $key => $value ) {
				if ( ! is_protected_meta( $key ) ) {
					$fields[ $key ] = $key;
				}
			}
			$this->add_control(
				'custom_field',
				[
					'label' => __( 'Custom Field', 'press-elements' ),
					'type' => Controls_Manager::SELECT,
					'options' => $fields,
				]
			);

			$this->add_control(
				'display',
				[
					'label' => __( 'Display As', 'press-elements' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'text' => __( 'Text', 'press-elements' ),
						'image' => __( 'Image', 'press-elements' ),
					],
					'default' => 'text',
				]
			);

			$this->add_control(
				'html_tag',
				[
					'label' => __( 'HTML Tag', 'press-elements' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
						'p' => 'p',
						'div' => 'div',
						'span' => 'span',
					],
					'default' => 'p',
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
						'post' => sprintf(
							/* translators: %s: Post type singular name (e.g. Post or Page) */
							__( '%s URL', 'press-elements' ),
							$post_type_object->labels->singular_name
						),
						'custom_field' => __( 'Other Custom Field', 'press-elements' ),
						'custom' => __( 'Custom URL', 'press-elements' ),
					],
				]
			);

			$this->add_control(
				'link',
				[
					'label' => __( 'Link', 'press-elements' ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'press-elements' ),
					'condition' => [
						'link_to' => 'custom',
					],
					'default' => [
						'url' => '',
					],
					'show_label' => false,
				]
			);

			$this->add_control(
				'custom_field_link',
				[
					'label' => __( 'Custom Field Link', 'press-elements' ),
					'type' => Controls_Manager::SELECT,
					'options' => $fields,
					'condition' => [
						'link_to' => 'custom_field',
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_style',
				[
					'label' => sprintf(
						/* translators: %s: Post type singular name (e.g. Post or Page) */
						__( '%s Custom Field', 'press-elements' ),
						$post_type_object->labels->singular_name
					),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'color',
				[
					'label' => __( 'Text Color', 'press-elements' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-custom-field' => 'color: {{VALUE}};',
						'{{WRAPPER}} .press-elements-custom-field a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'display' => 'text',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .press-elements-custom-field',
					'condition' => [
						'display' => 'text',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'text_shadow',
					'selector' => '{{WRAPPER}} .press-elements-custom-field',
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
						'{{WRAPPER}} .press-elements-custom-field img' => 'max-width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'display' => 'image',
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
						'{{WRAPPER}} .press-elements-custom-field img' => 'opacity: {{SIZE}};',
					],
					'condition' => [
						'display' => 'image',
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
						'{{WRAPPER}} .press-elements-custom-field img' => '-webkit-transform: rotate({{SIZE}}deg); -moz-transform: rotate({{SIZE}}deg); -ms-transform: rotate({{SIZE}}deg); -o-transform: rotate({{SIZE}}deg); transform: rotate({{SIZE}}deg);',
					],
					'condition' => [
						'display' => 'image',
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
					'selector' => '{{WRAPPER}} .press-elements-custom-field img',
					'condition' => [
						'display' => 'image',
					],
				]
			);

			$this->add_control(
				'image_border_radius',
				[
					'label' => __( 'Border Radius', 'press-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .press-elements-custom-field img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'display' => 'image',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'image_box_shadow',
					'selector' => '{{WRAPPER}} .press-elements-custom-field img',
					'condition' => [
						'display' => 'image',
					],
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		if ( press_elements_freemius()->is__premium_only() ) {

			$settings = $this->get_settings();

			$post_custom_fields = get_post_custom();
			$custom_field_key = $settings['custom_field'];

			if ( array_key_exists( $custom_field_key, $post_custom_fields ) )
				$custom_field_value = $post_custom_fields[ $custom_field_key ];
			else
				return;

			if ( empty( $custom_field_value[0] ) )
				return;

			switch ( $settings['display'] ) {
				case 'image' :
					$custom_field = '<img src="' . $custom_field_value[0] . '" />';
					break;

				case 'text' :
				default:
					$custom_field = $custom_field_value[0];
					break;
			}

			switch ( $settings['link_to'] ) {
				case 'custom' :
					if ( ! empty( $settings['link']['url'] ) ) {
						$link = esc_url( $settings['link']['url'] );
					} else {
						$link = false;
					}
					break;

				case 'custom_field' :
					$custom_field_value = $post_custom_fields[ $settings['custom_field_link'] ];
					$link = esc_url( $custom_field_value[0] );
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

			$html = sprintf( '<%1$s class="press-elements-custom-field %2$s">', $settings['html_tag'], $animation_class );
			if ( $link ) {
				$html .= sprintf( '<a href="%1$s" %2$s>%3$s</a>', $link, $target, $custom_field );
			} else {
				$html .= $custom_field;
			}
			$html .= sprintf( '</%s>', $settings['html_tag'] );

			echo $html;

		}

	}

	protected function _content_template() {

		if ( press_elements_freemius()->is__premium_only() ) {

			$post_custom_fields = get_post_custom();
			?>
			<#
				var custom_fields = [];
				<?php
				foreach ( $post_custom_fields as $key => $value ) {
					if ( ! is_protected_meta( $key ) ) {
						printf( 'custom_fields[ "%1$s" ] = "%2$s";', $key, sanitize_text_field( $value[0] ) );
					}
				}
				?>

				var custom_field = '';
				switch( settings.display ) {
					case 'image':
						custom_field = '<img src="' + custom_fields[ settings.custom_field ] + '" />';
						break;
					case 'text':
					default:
						custom_field = custom_fields[ settings.custom_field ];
				}

				var link_url;
				switch( settings.link_to ) {
					case 'custom':
						link_url = settings.link.url;
						break;
					case 'custom_field':
						link_url = custom_fields[ settings.custom_field_link ];
						break;
					case 'post':
						link_url = '<?php echo esc_url( get_the_permalink() ); ?>';
						break;
					case 'home':
						link_url = '<?php echo esc_url( get_home_url() ); ?>';
						break;
					case 'none':
					default:
						link_url = false;
				}
				var target = settings.link.is_external ? 'target="_blank"' : '';

				var animation_class = '';
				if ( '' !== settings.hover_animation ) {
					animation_class = 'elementor-animation-' + settings.hover_animation;
				}

				var html = '<' + settings.html_tag + ' class="press-elements-custom-field ' + animation_class + '">';
				if ( link_url ) {
					html += '<a href="' + link_url + '" ' + target + '>' + custom_field + '</a>';
				} else {
					html += custom_field;
				}
				html += '</' + settings.html_tag + '>';

				print( html );
			#>
			<?php

		}

	}

}
