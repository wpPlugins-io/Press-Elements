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
 * Press Elements Site Title
 *
 * Site title element for elementor.
 *
 * @since 1.0.0
 */
class Press_Elements_Site_Title extends Widget_Base {

	public function get_name() {
		return 'site-title';
	}

	public function get_title() {
		return __( 'Site Title', 'press-elements' );
	}

	public function get_icon() {
		return 'fa fa-home';
	}

	public function get_categories() {
		return [ 'press-elements-site-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Site Title', 'press-elements' ),
			]
		);

		$this->add_control(
			'title',
			[
				'type' => Controls_Manager::HIDDEN,
				'default' => get_bloginfo( 'name' ),
			]
		);

		$this->add_control(
			'header_size',
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
				'default' => 'h2',
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
			'link',
			[
				'label' => __( 'Link', 'press-elements' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default' => [
					'url' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Site Title', 'press-elements' ),
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
					'{{WRAPPER}} .press-elements-site-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .press-elements-site-title',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$title = get_bloginfo( 'name' );

		if ( empty( $title ) )
			return;

		$settings = $this->get_settings();

		$this->add_render_attribute( 'heading', 'class', 'press-elements-site-title' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}

		$html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $title );

		echo $html;
	}

	protected function _content_template() {
		?>
		<#
			var title = settings.title;

			if ( '' !== settings.link.url ) {
				title = '<a href="' + settings.link.url + '">' + title + '</a>';
			}

			var html = '<' + settings.header_size + ' class="press-elements-site-title">' + title + '</' + settings.header_size + '>';

			print( html );
		#>
		<?php
	}
}
