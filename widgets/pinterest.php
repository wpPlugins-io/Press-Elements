<?php
namespace PressElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Press Elements Pinterest
 *
 * Pinterest element for elementor.
 *
 * @since 1.5.0
 */
class Press_Elements_Pinterest extends Widget_Base {

	public function get_name() {
		return 'pinterest';
	}

	public function get_title() {
		return __( 'Pinterest', 'press-elements' );
	}

	public function get_icon() {
		return 'fa fa-pinterest';
	}

	public function get_categories() {
		return [ 'press-elements-integrations' ];
	}

	protected function _register_controls() {

		if ( ! press_elements_freemius()->is__premium_only() ) {

			$this->start_controls_section(
				'section_pro_feature',
				[
					'label' => __( 'Pinterest', 'press-elements' ),
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
					'label' => __( 'Pinterest', 'press-elements' ),
				]
			);

			$this->add_control(
				'pinterest_username',
				[
					'label' => __( 'Pinterest Username', 'press-elements' ),
					'type'  => Controls_Manager::TEXT,
					'placeholder' => __( 'pinterest', 'press-elements' ),
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
					'default' => 'pinterest_image',
					'options' => [
						'none' => __( 'None', 'press-elements' ),
						'pinterest_image' => __( 'Image page on pinterest', 'press-elements' ),
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
						'link_to' => 'pinterest_image'
					]
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_style',
				[
					'label' => __( 'Pinterest', 'press-elements' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'cols',
				[
					'label' => __( 'Colomns Per Row', 'press-elements' ),
					'type'  => Controls_Manager::SLIDER,
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
					'label' => __( 'Number of Rows', 'press-elements' ),
					'type'  => Controls_Manager::SLIDER,
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
					'label' => __( 'Opacity (%)', 'press-elements' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 1,
							'min' => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .elementor-pinterest img' => 'opacity: {{SIZE}};',
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
						'{{WRAPPER}} .press-elements-pinterest img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

		}

	}

	protected function render() {

		if ( press_elements_freemius()->is__premium_only() ) {

			$settings = $this->get_settings();

			$username = $settings['pinterest_username'];
			$rows     = $settings['rows']['size'];
			$cols     = $settings['cols']['size'];

			$row      = 0;
			$col      = 0;
			$width    = 100/$cols . '%';

			$target   = $settings['target'];
			$window   = ( 'new' == $target ) ? ' target=\"_blank\"' : '';

			$animation_class = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . $settings['hover_animation'] : '';

			$pins = $this->get_pins( $username, $rows*$cols );

			if ( ! is_null( $pins ) ) {
				echo '<div class="press-elements-pinterest">' . "\n";
				foreach ( $pins as $pin ) {
					if ( $col == 0 ) {
						echo '<div class="row">' . "\n";
					}
					$title  = $pin['title'];
					$url    = $pin['url'];
					$image  = $pin['image'];
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
				echo '</div>' . "\n";
			}

		}

	}

	protected function _content_template() {
	}

	public function get_pins( $username, $total_pins ) {

		// Set RSS cache lifetime in seconds
		$cache_lifetime = 900;
		add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return ' . $cache_lifetime . ';' ) );

		// Get the RSS feed
		$url = sprintf( 'https://pinterest.com/%s/feed.rss', $username );
		$rss = fetch_feed( $url );
		if ( is_wp_error( $rss ) ) {
			return null;
		}

		$maxitems  = $rss->get_item_quantity( $total_pins );
		$rss_items = $rss->get_items( 0, $maxitems );

		if ( is_null( $rss_items ) )
			return null;

		// Build patterns to search/replace in the image urls. Pattern to replace for the images.
		$search  = array( '_b.jpg' );
		$replace = array( '_t.jpg' );

		// Make urls protocol relative
		array_push( $search, 'https://' );
		array_push( $replace, '//' );

		$pins = array();
		foreach ( $rss_items as $item ) {
			$title       = $item->get_title();
			$description = $item->get_description();
			$url         = $item->get_permalink();
			if ( preg_match_all( '/<img src="([^"]*)".*>/i', $description, $matches ) ) {
				$image = str_replace( $search, $replace, $matches[1][0] );
			}
			array_push( $pins, array(
				'title' => $title,
				'image' => $image,
				'url'   => $url
			) );
		}

		return $pins;

	}

}
