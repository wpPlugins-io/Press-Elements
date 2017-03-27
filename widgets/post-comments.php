<?php
namespace PressElements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Press Elements Post Comments
 *
 * Single post/page comments element for elementor.
 *
 * @since 1.1.0
 */
class Press_Elements_Post_Comments extends Widget_Base {

	public function get_name() {
		return 'post-comments';
	}

	public function get_title() {
		$queried_object = get_queried_object();
		$post_type_object = get_post_type_object( get_post_type( $queried_object ) );

		return sprintf(
			/* translators: %s: Post type singular name (e.g. Post or Page) */
			__( '%s Comments', 'press-elements' ),
			$post_type_object->labels->singular_name
		);
	}

	public function get_icon() {
		return 'fa fa-comment-o';
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
					__( '%s Comments', 'press-elements' ),
					$post_type_object->labels->singular_name
				),
			]
		);

		$this->add_control(
			'separate_comments',
			[
				'label' => __( 'Separate Comments', 'press-elements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true'  => __( 'True', 'press-elements' ),
					'false' => __( 'False', 'press-elements' ),
				],
				'default' => 'false',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();
		comments_template( '/comments.php', $settings['separate_comments'] );

	}

	protected function _content_template() {

		comments_template();

	}
}
