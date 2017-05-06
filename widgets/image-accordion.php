<?php
namespace PressElements\Widgets;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Image Accordion Effect
 *
 * Elementor widget for image accordion.
 *
 * @since 1.6.0
 */
class Press_Elements_Image_Accordion extends \Elementor\Widget_Base {

	public function get_name() {
		return 'image-accordion';
	}

	public function get_title() {
		return __( 'Image Accordion', 'press-elements' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'press-elements-effects' ];
	}

	protected function _register_controls() {

		if ( ! press_elements_freemius()->is__premium_only() ) {

			$this->start_controls_section(
				'section_pro_feature',
				[
					'label' => __( 'Image Accordion', 'press-elements' ),
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
					'label' => __( 'Image Accordion', 'press-elements' ),
				]
			);

			$this->add_control(
				'content',
				[
					'label' => __( 'Images', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'default' => [
						[
							'caption' => __( 'Type out sentence', 'press-elements' ),
						],
						[
							'caption' => __( 'and delete them', 'press-elements' ),
						],
						[
							'caption' => __( 'with beautifull animation', 'press-elements' ),
						],
					],
					'fields' => [
						[
							'name' => 'image',
							'label' => __( 'Image', 'press-elements' ),
							'type' => \Elementor\Controls_Manager::MEDIA,
							'default' => [
								'url' => \Elementor\Utils::get_placeholder_image_src()
							],
						],
						[
							'name' => 'caption',
							'label' => __( 'Caption', 'press-elements' ),
							'type' => \Elementor\Controls_Manager::TEXT,
							'placeholder' => __( 'Caption', 'press-elements' ),
							'label_block' => true,
						],
						[
							'name' => 'link',
							'label' => __( 'Link', 'press-elements' ),
							'type' => \Elementor\Controls_Manager::URL,
							'placeholder' => __( 'http://your-link.com', 'press-elements' ),
						]
					],
					'title_field' => '{{{ caption }}}',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'container_style',
				[
					'label' => __( 'Container', 'press-elements' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'container_height',
				[
					'label' => __( 'Height', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 250,
						'unit' => 'px',
					],
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 50,
							'max' => 2000,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion' => 'height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .press-elements-image-accordion ul li' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'container_direction',
				[
					'label' => __( 'Direction', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'label_block' => false,
					'options' => [
						'rtl' => [
							'title' => __( 'Right to Left', 'press-elements' ),
							'icon' => 'fa fa-arrow-left',
						],
						'ltr' => [
							'title' => __( 'Left to Right', 'press-elements' ),
							'icon' => 'fa fa-arrow-right',
						],
					],
					'default' => 'ltr',
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion' => 'direction: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'container_border',
					'selector' => '{{WRAPPER}} .press-elements-image-accordion',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'container_shadow',
					'selector' => '{{WRAPPER}} .press-elements-image-accordion',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'image_style',
				[
					'label' => __( 'Image', 'press-elements' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'image_align',
				[
					'label' => __( 'Image Alignment', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'label_block' => false,
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
					],
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul li' => 'background-position: center {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'transition_speed',
				[
					'label' => __( 'Transition Speed (ms)', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 500,
						'unit' => 'ms',
					],
					'range' => [
						'ms' => [
							'max' => 3000,
							'min' => 1,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul li' => '-webkit-transition: all {{SIZE}}{{UNIT}} ease;',
						'{{WRAPPER}} .press-elements-image-accordion ul li' => 'transition: all {{SIZE}}{{UNIT}} ease;',
						'{{WRAPPER}} .press-elements-image-accordion ul li div' => '-webkit-transition: all {{SIZE}}{{UNIT}} ease;',
						'{{WRAPPER}} .press-elements-image-accordion ul li div' => 'transition: all {{SIZE}}{{UNIT}} ease;',
						'{{WRAPPER}} .press-elements-image-accordion ul:hover li:hover div' => '-webkit-transition: all {{SIZE}}{{UNIT}} ease;',
						'{{WRAPPER}} .press-elements-image-accordion ul:hover li:hover div' => 'transition: all {{SIZE}}{{UNIT}} ease;',
					],
				]
			);

			$this->add_responsive_control(
				'opened_image_size',
				[
					'label' => __( 'Opened Image Size (%)', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 100,
						'unit' => '%'
					],
					'range' => [
						'%' => [
							'max' => 100,
							'min' => 1,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul:hover li:hover' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'image_border',
					'selector' => '{{WRAPPER}} .press-elements-image-accordion ul li',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'caption_style',
				[
					'label' => __( 'Caption', 'press-elements' ),
					'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'caption_align',
				[
					'label' => __( 'Alignment', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'label_block' => false,
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
					],
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul li' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'caption_vertical',
				[
					'label' => __( 'Vertical Alignment', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'label_block' => false,
					'options' => [
						'top' => [
							'title' => __( 'Top', 'press-elements' ),
							'icon' => 'eicon-v-align-top',
						],
						'middle' => [
							'title' => __( 'Middle', 'press-elements' ),
							'icon' => 'eicon-v-align-middle',
						],
						'bottom' => [
							'title' => __( 'Bottom', 'press-elements' ),
							'icon' => 'eicon-v-align-bottom',
						],
					],
					'default' => 'middle',
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul li' => 'vertical-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'caption_color',
				[
					'label' => __( 'Text Color', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#fff',
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul li' => 'color: {{VALUE}};',
						'{{WRAPPER}} .press-elements-image-accordion ul li a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'caption_background_color',
				[
					'label' => __( 'Background Color', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => 'rgba(255,255,255,0.3)',
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul li div' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .press-elements-image-accordion ul li',
				]
			);

			$this->add_control(
				'caption_html_tag',
				[
					'label' => __( 'HTML Tag', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::SELECT,
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
				'caption_margin',
				[
					'label' => __( 'Margin', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default' => [
						'top' => 10,
						'right' => 10,
						'left' => 10,
						'bottom' => 10,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul li div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'caption_padding',
				[
					'label' => __( 'Padding', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default' => [
						'top' => 10,
						'right' => 10,
						'left' => 10,
						'bottom' => 10,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul li div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'caption_border',
					'selector' => '{{WRAPPER}} .press-elements-image-accordion ul li div',
				]
			);

			$this->add_control(
				'image_border_radius',
				[
					'label' => __( 'Border Radius', 'press-elements' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'top' => 10,
						'right' => 10,
						'left' => 10,
						'bottom' => 10,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-image-accordion ul li div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'caption_shadow',
					'selector' => '{{WRAPPER}} .press-elements-image-accordion ul li div',
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		if ( press_elements_freemius()->is__premium_only() ) {

			$settings = $this->get_settings();
			$i = 0;
			?>
			<div class="press-elements-image-accordion">
				<ul>
				<?php foreach ( $settings['content'] as $item ) { $i++; ?>
					<li style="background-image: url('<?php echo $item['image']['url']; ?>'); z-index: <?php echo $i; ?>">
					<?php if ( $item['caption'] ) { ?>
						<div>
						<?php if ( $item['link']['url'] ) { ?>
							<?php printf( '<%s>', $settings['caption_html_tag'] ); ?><a href="<?php echo $item['link']['url']; ?>"<?php if ( $item['link']['is_external'] ) { echo ' target="_blank"'; } ?>><?php echo $item['caption']; ?></a></<?php echo $settings['caption_html_tag']; ?>>
						<?php } else { ?>
							<<?php echo $settings['caption_html_tag']; ?>><?php echo $item['caption']; ?></<?php echo $settings['caption_html_tag']; ?>>
						<?php } ?>
						</div>
					<?php } ?>
					</li>
				<?php } ?>
				</ul>
			</div>
			<style>
			.press-elements-image-accordion ul li { width: <?php echo ( 100/$i ); ?>%; }
			.press-elements-image-accordion ul:hover li { width: <?php echo ( 100/$i/2 ); ?>%; }
			</style>
			<?php

		}

	}

	protected function _content_template() {
	}

}
