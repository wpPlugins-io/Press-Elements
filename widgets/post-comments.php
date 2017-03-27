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
			'logo',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'This widget displays the default Comments Template included in the current Theme.', 'press-elements' ) .
						'<br><br>' .
						__( 'No custom styling can be applied as each theme uses it\'s own CSS classes and IDs.', 'press-elements' ),
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		comments_template();
	}

	protected function _content_template() {
		comments_template();
	}
}
