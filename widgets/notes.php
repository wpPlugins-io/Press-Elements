<?php
namespace PressElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Notes
 *
 * Elementor widget for notes.
 *
 * @since 1.6.0
 */
class Press_Elements_Notes extends Widget_Base {

	public function get_name() {
		return 'notes';
	}

	public function get_title() {
		return __( 'Notes', 'press-elements' );
	}

	public function get_icon() {
		return 'fa fa-thumb-tack';
	}

	public function get_categories() {
		return [ 'press-elements-effects' ];
	}

	protected function _register_controls() {

		if ( ! press_elements_freemius()->is__premium_only() ) {

			$this->start_controls_section(
				'section_pro_feature',
				[
					'label' => __( 'Notes', 'press-elements' ),
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
					'label' => __( 'Note', 'press-elements' ),
				]
			);

			$this->add_control(
				'note_title',
				[
					'label' => __( 'Note Title', 'press-elements' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'note_content',
				[
					'label' => __( 'Note Content', 'press-elements' ),
					'type' => Controls_Manager::WYSIWYG,
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'note_style',
				[
					'label' => __( 'Note', 'press-elements' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'container_color',
				[
					'label' => __( 'Background', 'press-elements' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => '#F7E999',
					'selectors' => [
						'{{WRAPPER}} .press-elements-notes' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'sticker_color',
				[
					'label' => __( 'Sticker Color', 'press-elements' ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'default' => 'rgba(227, 200, 114, 0.4)',
					'selectors' => [
						'{{WRAPPER}} .press-elements-notes:before' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
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
						'{{WRAPPER}} .press-elements-notes' => 'opacity: {{SIZE}};',
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
						'size' => 2,
						'unit' => 'deg',
					],
					'range' => [
						'deg' => [
							'max' => 360,
							'min' => -360,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-notes' => '-webkit-transform: rotate({{SIZE}}deg); -moz-transform: rotate({{SIZE}}deg); -ms-transform: rotate({{SIZE}}deg); -o-transform: rotate({{SIZE}}deg); transform: rotate({{SIZE}}deg);',
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

			$this->add_responsive_control(
				'padding',
				[
					'label' => __( 'Padding', 'press-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default' => [
						'unit' => 'px',
						'top' => 30,
						'left' => 30,
						'right' => 30,
						'bottom' => 30,
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-notes' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'container_shadow',
					'selector' => '{{WRAPPER}} .press-elements-notes',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'title_style',
				[
					'label' => __( 'Title', 'press-elements' ),
					'tab' => Controls_Manager::TAB_STYLE,
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
					'default' => 'h3',
				]
			);

			$this->add_responsive_control(
				'title_align',
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
					'selectors' => [
						'{{WRAPPER}} .press-elements-notes .note-title' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Text Color', 'press-elements' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-notes .note-title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .press-elements-notes .note-title',
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'title_shadow',
					'selectors' => [
					'selector' => '{{WRAPPER}} .press-elements-notes .note-title',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'content_style',
				[
					'label' => __( 'Content', 'press-elements' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'content_align',
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
					'selectors' => [
						'{{WRAPPER}} .press-elements-notes .note-content' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'content_color',
				[
					'label' => __( 'Text Color', 'press-elements' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-notes .note-content' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'content_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .press-elements-notes .note-content',
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' => 'content_shadow',
					'selector' => '{{WRAPPER}} .press-elements-notes .note-content',
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		if ( press_elements_freemius()->is__premium_only() ) {

			$settings = $this->get_settings();
			$animation_class = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . $settings['hover_animation'] : '';
			printf(
				'<div class="press-elements-notes %1$s"> <%2$s class="note-title"> %3$s </%2$s> <div class="note-content"> %4$s </div> </div>',
				$animation_class,
				$settings['html_tag'],
				$settings['note_title'],
				$this->parse_text_editor( $settings['note_content'] )
			);

		}

	}

	protected function _content_template() {
	}

}
