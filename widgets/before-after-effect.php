<?php
namespace PressElements\Widgets;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Before After Effect
 *
 * Elementor widget for before after effect.
 *
 * @since 1.6.0
 */
class Press_Elements_Before_After_Effect extends \Elementor\Widget_Base {

	public function get_name() {
		return 'before-after-effect';
	}

	public function get_title() {
		return __( 'Before After Effect', 'press-elements' );
	}

	public function get_icon() {
		return 'fa fa-columns';
	}

	public function get_categories() {
		return [ 'press-elements-effects' ];
	}

	public function get_script_depends() {
		return [ 'before-after-effect' ];
	}

	protected function _register_controls() {

		if ( ! press_elements_freemius()->is__premium_only() ) {

			$this->start_controls_section(
				'section_pro_feature',
				[
					'label' => __( 'Before After Effect', 'press-elements' ),
				]
			);

			$this->add_control(
				'pro_feature',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
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
					'label' => __( 'Before After Effect', 'press-elements' ),
				]
			);

			$this->add_control(
			    'before',
			    [
			        'label' => __( 'Title & Image', 'press-elements' ),
			        'type' => \Elementor\Controls_Manager::HEADING,
			        'separator' => 'before',
			    ]
			);

			$this->add_control(
				'before_text',
				[
					'label' => __( 'Text', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Before', 'press-elements' ),
					'label_block' => 'true',
					'show_label' => false,
					'separator' => 'none',
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-before-label:before' => 'content: "{{VALUE}}";',
					],
				]
			);

			$this->add_control(
				'before_image',
				[
					'label' => __( 'Image', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
					'show_label' => false,
					'separator' => 'none'
				]
			);

			$this->add_control(
			    'after',
			    [
			        'label' => __( 'Title & Image', 'press-elements' ),
			        'type' => \Elementor\Controls_Manager::HEADING,
			        'separator' => 'before',
			    ]
			);

			$this->add_control(
				'after_text',
				[
					'label' => __( 'Text', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'After', 'press-elements' ),
					'label_block' => 'true',
					'show_label' => false,
					'separator' => 'none',
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-after-label:before' => 'content: "{{VALUE}}";',
					],
				]
			);

			$this->add_control(
				'after_image',
				[
					'label' => __( 'Image', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
					'show_label' => false,
					'separator' => 'none'
				]
			);

			$this->add_control(
			    'settings',
			    [
			        'label' => __( 'Settings', 'press-elements' ),
			        'type' => \Elementor\Controls_Manager::HEADING,
			        'separator' => 'before',
			    ]
			);

			$this->add_control(
				'orientation',
				[
					'label' => __( 'Orientation', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SELECT,
			        'options' => [
					'horizontal' => __( 'Horizontal', 'press-elements' ),
					'vertical' => __( 'Vertical', 'press-elements' ),
			        ],
					'default' => 'horizontal',
					'separator' => 'none',
				]
			);

			$this->add_control(
				'starting_position',
				[
					'label' => __( 'Starting Position (%)', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 50,
						'unit' => '%',
					],
					'size_units' => [ '%' ],
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'separator' => 'none',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'overlay_style',
				[
					'label' => __( 'Overlay', 'press-elements' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'overlay_color',
				[
					'label' => __( 'Overlay Color', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => 'rgba(0, 0, 0, 0.5)',
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-overlay:hover' => 'background-color: {{VALUE}};',
						/*
						'{{WRAPPER}} .twentytwenty-overlay' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-container.active .twentytwenty-overlay' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-container.active :hover.twentytwenty-overlay' => 'background-color: {{VALUE}};',
						*/
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'separetor_style',
				[
					'label' => __( 'Separetor', 'press-elements' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'separator_color',
				[
					'label' => __( 'Separetor Color', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#ffffff',
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before' => 'background: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'background: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before' => 'background: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'background: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-handle' => 'border-color: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'separator_size',
				[
					'label' => __( 'Separetor Width (px)', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 4,
						'unit' => 'px',
					],
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before' => 'width: {{SIZE}}{{UNIT}};', /*  margin-left: {{SIZE}}{{UNIT}} / 2 */
						'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}};',  /*  margin-left: {{SIZE}}{{UNIT}} / 2 */
						'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before' => 'height: {{SIZE}}{{UNIT}};',  /*  margin-top: {{SIZE}}{{UNIT}} / 2 */
						'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}};',   /*  margin-top: {{SIZE}}{{UNIT}} / 2 */
						'{{WRAPPER}} .twentytwenty-handle' => 'border-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'separator_radius',
				[
					'label' => __( 'Separetor Radius', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'top' => 50,
						'right' => 50,
						'left' => 50,
						'bottom' => 50,
						'unit' => 'px'
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-handle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			/*
			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'separator_shadow',
					'selector' => [
						'{{WRAPPER}} .twentytwenty-handle,
						{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before,
						{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after,
						{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before,
						{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after
						',
					],
				]
			);
			*/

			$this->end_controls_section();

			$this->start_controls_section(
				'title_style',
				[
					'label' => __( 'Title', 'press-elements' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'content_color',
				[
					'label' => __( 'Text Color', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#ffffff',
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-before-label:before' => 'color: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-after-label:before' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'title_background',
				[
					'label' => __( 'Background Color', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => 'rgba(255, 255, 255, 0.2)',
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-before-label:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .twentytwenty-after-label:before' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-before-label:before',
						'{{WRAPPER}} .twentytwenty-after-label:before',
					],
				]
			);

			$this->add_responsive_control(
				'title_horizontal_before',
				[
					'label' => __( '1st Title Position (%)', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ '%' ],
					'range' => [
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'size' => 44,
						'unit' => '%',
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-before-label:before' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'orientation' => 'horizontal'
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'title_horizontal_after',
				[
					'label' => __( '2nd Title Position (%)', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ '%' ],
					'range' => [
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'size' => 44,
						'unit' => '%',
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-after-label:before' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'orientation' => 'horizontal'
					],
				]
			);

			$this->add_responsive_control(
				'title_vertical_before',
				[
					'label' => __( '1st Title Position (%)', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ '%' ],
					'range' => [
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'size' => 44,
						'unit' => '%',
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'orientation' => 'vertical'
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'title_vertical_after',
				[
					'label' => __( '2nd Title Position (%)', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ '%' ],
					'range' => [
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'size' => 44,
						'unit' => '%',
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-after-label:before' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'orientation' => 'vertical'
					],
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label' => __( 'Margin', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default' => [
						'top' => 10,
						'right' => 20,
						'left' => 20,
						'bottom' => 10,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-before-label:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .twentytwenty-after-label:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'title_padding',
				[
					'label' => __( 'Padding', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default' => [
						'top' => 10,
						'right' => 20,
						'left' => 20,
						'bottom' => 10,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-before-label:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .twentytwenty-after-label:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'title_border',
					'selector' => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before',
				]
			);

			$this->add_control(
				'label_border_radius',
				[
					'label' => __( 'Border Radius', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'top' => 5,
						'right' => 5,
						'left' => 5,
						'bottom' => 5,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .twentytwenty-before-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .twentytwenty-after-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'title_shadow',
					'selector' => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before',
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		if ( press_elements_freemius()->is__premium_only() ) {

			$settings = $this->get_settings();
			?>
			<div class="press-elements-before-after-effect twentytwenty-container" data-orientation="<?php echo $settings['orientation']; ?>" data-starting-position="<?php echo $settings['starting_position']['size']/100; ?>">
				<img src="<?php echo $settings['before_image']['url']; ?>" alt="<?php echo $settings['before_text']; ?>">
				<img src="<?php echo $settings['after_image']['url']; ?>" alt="<?php echo $settings['after_text']; ?>">
			</div>
			<?php
		}

	}

	protected function _content_template() {
	}

}
