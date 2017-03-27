<?php
namespace PressElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;



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
		$queried_object = get_queried_object();
		$post_type_object = get_post_type_object( get_post_type( $queried_object ) );

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

		$queried_object = get_queried_object();
		$post_type_object = get_post_type_object( get_post_type( $queried_object ) );

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


if ( press_elements_freemius()->is__premium_only() ) {

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
					'post' => sprintf(
						/* translators: %s: Post type singular name (e.g. Post or Page) */
						__( '%s URL', 'press-elements' ),
						$post_type_object->labels->singular_name
					),
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

} else {

		$this->add_control(
			'pro_content',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<div class="elementor-panel-nerd-box">
						<i class="elementor-panel-nerd-box-icon fa fa-lock"></i>
						<div class="elementor-panel-nerd-box-title">' .
							__( 'Premium Feature', 'press-elements' ) .
						'</div>
						<div class="elementor-panel-nerd-box-message">' .
							__( 'This feature is available only for Press Elements Pro.', 'press-elements' ) .
						'</div>
						<a class="elementor-panel-nerd-box-link elementor-button elementor-button-default elementor-go-pro" href="' . press_elements_freemius()->get_upgrade_url() . '" target="_blank">' .
							__( 'Upgrade Now!', 'press-elements' ) .
						'</a>
						</div>',
				'separator' => 'none',
			]
		);

}

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

if ( press_elements_freemius()->is__premium_only() ) {

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
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .press-elements-custom-field',
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'press-elements' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

} else {

		$this->add_control(
			'pro_style',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<div class="elementor-panel-nerd-box">
						<i class="elementor-panel-nerd-box-icon fa fa-lock"></i>
						<div class="elementor-panel-nerd-box-title">' .
							__( 'Premium Feature', 'press-elements' ) .
						'</div>
						<div class="elementor-panel-nerd-box-message">' .
							__( 'This feature is available only for Press Elements Pro.', 'press-elements' ) .
						'</div>
						<a class="elementor-panel-nerd-box-link elementor-button elementor-button-default elementor-go-pro" href="' . press_elements_freemius()->get_upgrade_url() . '" target="_blank">' .
							__( 'Upgrade Now!', 'press-elements' ) .
						'</a>
						</div>',
				'separator' => 'none',
			]
		);

}

		$this->end_controls_section();

	}

	protected function render() {

		if ( press_elements_freemius()->is__premium_only() ) {
			$settings = $this->get_settings();

			$custom_field = get_post_custom();
			$custom_field_key = $settings['custom_field'];

			if ( array_key_exists( $custom_field_key, $custom_field ) )
				$custom_field_value = $custom_field[ $custom_field_key ];
			else
				return;

			if ( empty( $custom_field_value[0] ) )
				return;

			switch ( $settings['link_to'] ) {
				case 'custom' :
					if ( ! empty( $settings['link']['url'] ) ) {
						$link = $settings['link']['url'];
					} else {
						$link = false;
					}
					break;

				case 'post' :
					$link = get_the_permalink();
					break;

				case 'none' :
				default:
					$link = false;
					break;
			}
			$target = $settings['link']['is_external'] ? 'target="_blank"' : '';

			$animation_class = ! empty( $settings['hover_animation'] ) ? ' elementor-animation-' . $settings['hover_animation'] : '';

			$html = sprintf( '<%1$s class="press-elements-custom-field%2$s">', $settings['html_tag'], $animation_class );
			if ( $link ) {
				$html .= sprintf( '<a href="%1$s" %2$s>%3$s</a>', $link, $target, $custom_field_value[0] );
			} else {
				$html .= $custom_field_value[0];
			}
			$html .= sprintf( '</%s>', $settings['html_tag'] );

			echo $html;
		}

	}

	protected function _content_template() {

		if ( press_elements_freemius()->is__premium_only() ) {
			$custom_field = get_post_custom();
			?>
			<#
				var custom_fields = [];
				<?php
				foreach ( $custom_field as $key => $value ) {
					if ( ! is_protected_meta( $key ) ) {
						printf( 'custom_fields[ "%1$s" ] = "%2$s";', $key, sanitize_text_field( $value[0] ) );
					}
				}
				?>
				var custom_field = custom_fields[ settings.custom_field ];

				var link_url;
				switch( settings.link_to ) {
					case 'custom':
						link_url = settings.link.url;
						break;
					case 'post':
						link_url = '<?php echo get_the_permalink(); ?>';
						break;
					case 'none':
					default:
						link_url = false;
				}
				var target = settings.link.is_external ? 'target="_blank"' : '';

				var animation_class;
				if ( '' !== settings.hover_animation ) {
					animation_class = ' elementor-animation-' + settings.hover_animation;
				}

				var html = '<' + settings.html_tag + ' class="press-elements-custom-field' + animation_class + '">';
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
