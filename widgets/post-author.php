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
 * Press Elements Post Author
 *
 * Single post/page author element for elementor.
 *
 * @since 1.0.0
 */
class Press_Elements_Post_Author extends Widget_Base {

	public function get_name() {
		return 'post-author';
	}

	public function get_title() {
		$queried_object = get_queried_object();
		$post_type_object = get_post_type_object( get_post_type( $queried_object ) );

		return sprintf(
			/* translators: %s: Post type singular name (e.g. Post or Page) */
			__( '%s Author', 'press-elements' ),
			$post_type_object->labels->singular_name
		);
	}

	public function get_icon() {
		return 'fa fa-user-circle-o';
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
					__( '%s Author', 'press-elements' ),
					$post_type_object->labels->singular_name
				),
			]
		);

		$this->add_control(
			'author',
			[
				'label' => __( 'Author', 'press-elements' ),
				'type' => Controls_Manager::SELECT,
				'options' => $this->user_fields_labels(),
				'default' => 'display_name',
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
					'author' => __( 'Author URL', 'press-elements' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => sprintf(
					/* translators: %s: Post type singular name (e.g. Post or Page) */
					__( '%s Author', 'press-elements' ),
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
					'{{WRAPPER}} .press-elements-author' => 'color: {{VALUE}};',
					'{{WRAPPER}} .press-elements-author a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .press-elements-author',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['author'] ) )
			return;

		$author = $this->user_data( $settings['author'] );

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

			case 'author' :
				$link = get_author_posts_url( get_the_author_meta( 'ID' ) );
				break;

			case 'none' :
			default:
				$link = false;
				break;
		}
		$target = $settings['link']['is_external'] ? 'target="_blank"' : '';

		$html = sprintf( '<%s class="press-elements-author">', $settings['html_tag'] );
		if ( $link ) {
			$html .= sprintf( '<a href="%1$s" %2$s>%3$s</a>', $link, $target, $author );
		} else {
			$html .= $author;
		}
		$html .= sprintf( '</%s>', $settings['html_tag'] );

		echo $html;
	}

	protected function _content_template() {
		?>
		<#
			var author_data = [];
			<?php
			foreach ( $this->user_data() as $key => $value ) {
				printf( 'author_data[ "%1$s" ] = "%2$s";', $key, $value );
			}
			?>
			var author = author_data[ settings.author ];

			var link_url;
			switch( settings.link_to ) {
				case 'custom':
					link_url = settings.link.url;
					break;
				case 'post':
					link_url = '<?php echo get_the_permalink(); ?>';
					break;
				case 'author':
					link_url = '<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>';
					break;
				case 'none':
				default:
					link_url = false;
			}
			var target = settings.link.is_external ? 'target="_blank"' : '';

			var html = '<' + settings.html_tag + ' class="press-elements-author">';
			if ( link_url ) {
				html += '<a href="' + link_url + '" ' + target + '>' + author + '</a>';
			} else {
				html += author;
			}
			html += '</' + settings.html_tag + '>';

			print( html );
		#>
		<?php
	}

	protected function user_fields_labels() {

		$fields = [
			'first_name'   => __( 'First Name', 'press-elements' ),
			'last_name'    => __( 'Last Name', 'press-elements' ),
			'first_last'   => __( 'First Name + Last Name', 'press-elements' ),
			'last_first'   => __( 'Last Name + First Name', 'press-elements' ),
			'nickname'     => __( 'Nick Name', 'press-elements' ),
			'display_name' => __( 'Display Name', 'press-elements' ),
			'user_login'   => __( 'User Name', 'press-elements' ),
			'description'  => __( 'User Bio', 'press-elements' ),
			'image'        => __( 'User Image', 'press-elements' ),
		];

		return $fields;

	}

	protected function user_data( $selected = '' ) {

		// Get cusrrent post data
		$queried_object = get_queried_object();
		$author_id = is_object( $queried_object ) ? $queried_object->post_author : 0;

		$fields = [
			'first_name'   => get_the_author_meta( 'first_name', $author_id ),
			'last_name'    => get_the_author_meta( 'last_name', $author_id ),
			'first_last'   => sprintf( '%s %s', get_the_author_meta( 'first_name', $author_id ), get_the_author_meta( 'last_name', $author_id ) ),
			'last_first'   => sprintf( '%s %s', get_the_author_meta( 'last_name', $author_id ), get_the_author_meta( 'first_name', $author_id ) ),
			'nickname'     => get_the_author_meta( 'nickname', $author_id ),
			'display_name' => get_the_author_meta( 'display_name', $author_id ),
			'user_login'   => get_the_author_meta( 'user_login', $author_id ),
			'description'  => get_the_author_meta( 'description', $author_id ),
			'image'        => get_avatar( get_the_author_meta( 'email', $author_id ), 256 ),
		];

		if ( empty( $selected ) ) {
			// Return the entire array
			return $fields;
		} else {
			// Return only the selected field
			return $fields[ $selected ];
		}

	}

}
