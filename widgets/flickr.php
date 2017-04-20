<?php
namespace PressElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Press Elements Flickr
 *
 * Flickr element for elementor.
 *
 * @since 1.5.0
 */
class Press_Elements_Flickr extends Widget_Base {

	public function get_name() {
		return 'flickr';
	}

	public function get_title() {
		return __( 'Flickr', 'press-elements' );
	}

	public function get_icon() {
		return 'fa fa-flickr';
	}

	public function get_categories() {
		return [ 'press-elements-integrations' ];
	}

	protected function _register_controls() {

		if ( ! press_elements_freemius()->is__premium_only() ) {

			$this->start_controls_section(
				'section_pro_feature',
				[
					'label' => __( 'Flickr', 'press-elements' ),
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
					'label' => __( 'Flickr', 'press-elements' ),
				]
			);

			$this->add_control(
				'flickrid',
				[
					'label'       => __( 'Flickr ID', 'press-elements' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => '123456789@N00'
				]
			);

			$this->add_control(
				'links',
				[
					'label'     => __( 'Links', 'elementor-gravatar' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'link_to',
				[
					'label' => __( 'Link to', 'press-elements' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'flickr_image',
					'options' => [
						'none' => __( 'None', 'press-elements' ),
						'flickr_image' => __( 'Image page on Flickr', 'press-elements' ),
					],
				]
			);

			$this->add_control(
				'target',
				[
					'label'   => __( 'Open links in', 'press-elements' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default' => __( 'Same window', 'press-elements' ),
						'new'     => __( 'New window',  'press-elements' ),
					],
					'condition' => [
						'link_to' => 'flickr_image'
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_style',
				[
					'label' => __( 'Flickr', 'press-elements' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'size',
				[
					'label'   => __( 'Size', 'press-elements' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'fullsize',
					'options' => [
						'thumbnails' => __( 'Thumbnails Grid',  'press-elements' ),
						'fullsize'   => __( 'Full Images Grid', 'press-elements' ),
					],
				]
			);

			$this->add_control(
				'cols',
				[
					'label'   => __( 'Colomns Per Row', 'press-elements' ),
					'type'    => Controls_Manager::SLIDER,
					'default' => [
						'size' => 3,
						'unit' => 'cols',
					],
					'size_units' => [ 'cols' ],
					'range' => [
						'cols' => [
							'min'  => 1,
							'max'  => 16,
							'step' => 1,
						],
					],
				]
			);

			$this->add_control(
				'rows',
				[
					'label'   => __( 'Number of Rows', 'press-elements' ),
					'type'    => Controls_Manager::SLIDER,
					'default' => [
						'size' => 3,
						'unit' => 'cols',
					],
					'size_units' => [ 'cols' ],
					'range' => [
						'cols' => [
							'min'  => 1,
							'max'  => 16,
							'step' => 1,
						],
					],
				]
			);

			$this->add_control(
				'opacity',
				[
					'label'   => __( 'Opacity (%)', 'press-elements' ),
					'type'    => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 1,
							'min' => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .press-elements-flickr img' => 'opacity: {{SIZE}};',
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
					'selectors' => [
						'{{WRAPPER}} .press-elements-flickr img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		if ( press_elements_freemius()->is__premium_only() ) {

			$settings = $this->get_settings();

			$flickrid = $settings['flickrid'];
			$size     = $settings['size'];
			$rows     = $settings['rows']['size'];
			$cols     = $settings['cols']['size'];

			$row      = 0;
			$col      = 0;
			$width    = 100/$cols . '%';

			$target   = $settings['target'];
			$window   = ( 'new' == $target ) ? ' target="_blank"' : '';

			$animation_class = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . $settings['hover_animation'] : '';

			// Use WordPress feed
			include_once(ABSPATH . WPINC . '/feed.php');

			// Retrieve Flickr items
			$rss = fetch_feed('http://api.flickr.com/services/feeds/photos_public.gne?ids=' . esc_attr( $flickrid ) . '&lang=en-us&format=rss2');

			// Cache - Set transient lifetime
			add_filter( 'wp_feed_cache_transient_lifetime', function(){ return 1800; } );

			// Error check
			if( ! is_wp_error( $rss ) ) {
				$items = $rss->get_items( 0, $rss->get_item_quantity( $rows*$cols ) );
			}

			// Output
			if ( isset( $items ) ) {
				echo '<div class="press-elements-flickr">' . "\n";
				foreach( $items as $item ) {

					switch ( $size ) {
						case 'thumbnails':
							$image_group = $item->get_item_tags( 'http://search.yahoo.com/mrss/', 'thumbnail' );
							break;
						case 'fullsize':
						default:
							$image_group = $item->get_item_tags( 'http://search.yahoo.com/mrss/', 'content' );
							break;
					}

					$image_attrs = $image_group[0]['attribs'];
					foreach( $image_attrs as $image ) {
						if ( $col == 0 ) {
							echo '<div class="row">' . "\n";
						}
						$title  = $item->get_title();
						$url    = $item->get_permalink();
						$image  = $image['url'];
						switch ( $settings['link_to'] ) {
							case 'flickr_image' :
								$link = $item->get_permalink();
								break;

							case 'none' :
							default:
								$link = false;
								break;
						}
						if ( $link ) {
							echo "<a href=\"$url\"$window><img src=\"$image\" alt=\"$title\" width=\"$width\" class=\"$animation_class\" /></a>";
						} else {
							echo "<img src=\"$image\" alt=\"$title\" width=\"$width\" class=\"$animation_class\" />";
						}
						$col++;
						if ( $col >= $cols ) {
							echo '</div>' . "\n";
							$col = 0;
							$row++;
						}
					}

				}
				echo '</div>' . "\n";
			}

		}

	}

	protected function _content_template() {
	}

}
